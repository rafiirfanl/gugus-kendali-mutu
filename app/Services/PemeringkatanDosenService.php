<?php

namespace App\Services;

use App\Models\DokumenPerkuliahan;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class PemeringkatanDosenService
{
    public const POIN_TEPAT_WAKTU = 100;

    public const POIN_TERLAMBAT = -25;

    public const POIN_TIDAK_TERKUMPUL = -100;

    public const BONUS_KECEPATAN = [
        1 => 50,
        2 => 30,
        3 => 15,
    ];

    /**
     * Hitung leaderboard pemeringkatan dosen berdasarkan kepatuhan
     * pengumpulan dokumen perkuliahan (point-based scoring).
     *
     * @param  Collection<int, Kelas>  $kelasList  kelas pada tahun ajaran terkait,
     *                                             eager loaded: dosen.prodi, matkulDibuka.matkul.prodi, dokumenKelas.dokumenPerkuliahan
     * @param  TahunAjaran  $tahunAjaran  sumber tanggal_mulai_kuliah untuk deadline
     * @param  int|null  $prodiId  jika diisi, hanya baris tugas dari kelas prodi tsb yang dijumlahkan
     *                             (bonus kecepatan tetap dihitung menyeluruh se-tahun ajaran agar skor konsisten)
     * @return array<int, array<string, mixed>>
     */
    public function hitung(Collection $kelasList, TahunAjaran $tahunAjaran, ?int $prodiId = null): array
    {
        $bonus = $this->hitungBonusKecepatan($kelasList);

        $perDosen = [];

        foreach ($kelasList as $kelas) {
            $dosenId = $kelas->dosen_id;

            if (! $dosenId) {
                continue;
            }

            if ($prodiId !== null && (int) $kelas->matkulDibuka?->matkul?->prodi_id !== $prodiId) {
                continue;
            }

            if (! isset($perDosen[$dosenId])) {
                $dosen = $kelas->dosen;
                $perDosen[$dosenId] = [
                    'dosen' => $dosen,
                    'prodi' => $kelas->matkulDibuka?->matkul?->prodi?->nama_prodi
                        ?? $dosen?->prodi?->nama_prodi
                        ?? '-',
                    'total_poin' => 0,
                    'jumlah_tugas' => 0,
                    'tepat_waktu' => 0,
                    'terlambat' => 0,
                    'tidak_terkumpul' => 0,
                ];
            }

            foreach ($kelas->dokumenKelas as $dokumenKelas) {
                $dokumenPerkuliahanId = $dokumenKelas->dokumen_perkuliahan_id;
                $terkumpul = $dokumenKelas->status === 'dikumpulkan';

                if ($terkumpul) {
                    $waktu = $dokumenKelas->waktu_pengumpulan
                        ? Carbon::parse($dokumenKelas->waktu_pengumpulan)
                        : null;
                    $deadline = $this->deadline($dokumenKelas->dokumenPerkuliahan, $tahunAjaran);

                    if ($deadline === null || $waktu === null || $waktu->lte($deadline)) {
                        $poin = self::POIN_TEPAT_WAKTU;
                        $perDosen[$dosenId]['tepat_waktu']++;
                    } else {
                        $poin = self::POIN_TERLAMBAT;
                        $perDosen[$dosenId]['terlambat']++;
                    }

                    $poin += $bonus[$dokumenPerkuliahanId][$dosenId] ?? 0;
                } else {
                    $poin = self::POIN_TIDAK_TERKUMPUL;
                    $perDosen[$dosenId]['tidak_terkumpul']++;
                }

                $perDosen[$dosenId]['total_poin'] += $poin;
                $perDosen[$dosenId]['jumlah_tugas']++;
            }
        }

        return $this->urutkan($perDosen);
    }

    /**
     * Bonus kecepatan per dokumen perkuliahan, dihitung menyeluruh
     * se-tahun ajaran: tiap dosen diambil pengumpulan tercepatnya,
     * lalu 3 tercepat mendapat +50 / +30 / +15.
     *
     * @param  Collection<int, Kelas>  $kelasList
     * @return array<int, array<int, int>> [dokumen_perkuliahan_id][dosen_id] => bonus
     */
    public function hitungBonusKecepatan(Collection $kelasList): array
    {
        $tercepatPerDokumen = [];

        foreach ($kelasList as $kelas) {
            $dosenId = $kelas->dosen_id;

            if (! $dosenId) {
                continue;
            }

            foreach ($kelas->dokumenKelas as $dokumenKelas) {
                if ($dokumenKelas->status !== 'dikumpulkan' || ! $dokumenKelas->waktu_pengumpulan) {
                    continue;
                }

                $dokumenPerkuliahanId = $dokumenKelas->dokumen_perkuliahan_id;
                $waktu = Carbon::parse($dokumenKelas->waktu_pengumpulan);

                $sebelumnya = $tercepatPerDokumen[$dokumenPerkuliahanId][$dosenId] ?? null;

                if ($sebelumnya === null || $waktu->lt($sebelumnya)) {
                    $tercepatPerDokumen[$dokumenPerkuliahanId][$dosenId] = $waktu;
                }
            }
        }

        $bonus = [];

        foreach ($tercepatPerDokumen as $dokumenPerkuliahanId => $pengumpul) {
            // urutkan waktu pengumpulan, lalu dosen_id agar deterministik
            $urut = [];
            foreach ($pengumpul as $dosenId => $waktu) {
                $urut[] = ['dosen_id' => $dosenId, 'waktu' => $waktu];
            }
            usort($urut, function (array $a, array $b) {
                return [$a['waktu'], $a['dosen_id']] <=> [$b['waktu'], $b['dosen_id']];
            });

            foreach ($urut as $index => $item) {
                $peringkat = $index + 1;

                if (! isset(self::BONUS_KECEPATAN[$peringkat])) {
                    break;
                }

                $bonus[$dokumenPerkuliahanId][$item['dosen_id']] = self::BONUS_KECEPATAN[$peringkat];
            }
        }

        return $bonus;
    }

    /**
     * Deadline dokumen = tanggal_mulai_kuliah + (tenggat_waktu_default x 7 hari),
     * pukul 23:59:59. Mendukung nilai negatif (tenggat sebelum kuliah dimulai).
     */
    public function deadline(?DokumenPerkuliahan $dokumenPerkuliahan, TahunAjaran $tahunAjaran): ?Carbon
    {
        if (! $dokumenPerkuliahan || $dokumenPerkuliahan->tenggat_waktu_default === null) {
            return null;
        }

        if (! $tahunAjaran->tanggal_mulai_kuliah) {
            return null;
        }

        return Carbon::parse($tahunAjaran->tanggal_mulai_kuliah)
            ->addDays(7 * (int) $dokumenPerkuliahan->tenggat_waktu_default)
            ->endOfDay();
    }

    /**
     * Agregasi per dosen -> score, on-time rate, lalu urut
     * score DESC, onTimeRate DESC dengan competition ranking (1, 1, 3).
     *
     * @param  array<int, array<string, mixed>>  $perDosen
     * @return array<int, array<string, mixed>>
     */
    private function urutkan(array $perDosen): array
    {
        $hasil = [];

        foreach ($perDosen as $dosenId => $data) {
            if ($data['jumlah_tugas'] <= 0 || ! $data['dosen'] instanceof User) {
                continue;
            }

            $data['dosen_id'] = $dosenId;
            $data['score'] = round($data['total_poin'] / $data['jumlah_tugas'], 1);
            $data['on_time_rate'] = round(($data['tepat_waktu'] / $data['jumlah_tugas']) * 100, 1);

            $hasil[] = $data;
        }

        usort($hasil, function (array $a, array $b) {
            return [$b['score'], $b['on_time_rate']] <=> [$a['score'], $a['on_time_rate']];
        });

        $rank = 0;
        $sebelumnya = null;

        foreach ($hasil as $index => $baris) {
            $kunci = [$baris['score'], $baris['on_time_rate']];

            if ($sebelumnya === null || $kunci != $sebelumnya) {
                $rank = $index + 1;
                $sebelumnya = $kunci;
            }

            $hasil[$index]['rank'] = $rank;
        }

        return $hasil;
    }
}

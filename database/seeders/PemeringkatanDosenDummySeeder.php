<?php

namespace Database\Seeders;

use App\Models\DokumenKelas;
use App\Models\DokumenPerkuliahan;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class PemeringkatanDosenDummySeeder extends Seeder
{
    /**
     * Data dummy untuk Pemeringkatan Dosen:
     * 1. Jika tahun ajaran aktif belum punya kelas, clone struktur kelas
     *    (+ placeholder dokumen_kelas) dari tahun ajaran lain ke TA aktif.
     * 2. Isi status & waktu_pengumpulan pada baris dokumen_kelas yang masih
     *    kosong dengan pola realistis (tepat waktu / terlambat / ditolak /
     *    tidak terkumpul), deterministik dan tidak menimpa data yang ada.
     *
     * Jalankan: php artisan db:seed --class=PemeringkatanDosenDummySeeder
     */
    public function run(): void
    {
        $target = TahunAjaran::where('is_aktif', true)->orderBy('id')->first()
            ?? TahunAjaran::orderBy('id')->first();

        if (! $target) {
            $this->command?->warn('Belum ada tahun ajaran, tidak ada data yang bisa diisi.');

            return;
        }

        if (! Kelas::where('tahun_ajaran_id', $target->id)->exists()) {
            $this->cloneKelasKeTahunAjaran($target);
        }

        $kelasList = Kelas::with(['dokumenKelas.dokumenPerkuliahan', 'tahunAjaran'])->get();

        $terisi = 0;
        $dilewati = 0;

        foreach ($kelasList as $kelas) {
            $tanggalMulai = $kelas->tahunAjaran?->tanggal_mulai_kuliah
                ? Carbon::parse($kelas->tahunAjaran->tanggal_mulai_kuliah)
                : null;

            foreach ($kelas->dokumenKelas as $dokumenKelas) {
                if ($dokumenKelas->status !== null) {
                    $dilewati++;

                    continue;
                }

                $dokumenPerkuliahan = $dokumenKelas->dokumenPerkuliahan;

                if ($tanggalMulai === null
                    || ! $dokumenPerkuliahan
                    || $dokumenPerkuliahan->tenggat_waktu_default === null
                ) {
                    $dilewati++;

                    continue;
                }

                $deadline = $tanggalMulai->copy()
                    ->addDays(7 * (int) $dokumenPerkuliahan->tenggat_waktu_default)
                    ->endOfDay();

                $this->isiDummy($dokumenKelas, $deadline, $kelas->dosen_id);
                $terisi++;
            }
        }

        $this->command?->info("Dummy pemeringkatan dosen: {$terisi} baris diisi, {$dilewati} baris dilewati.");
    }

    /**
     * Clone kelas + placeholder dokumen_kelas dari tahun ajaran dengan
     * kelas terbanyak menuju tahun ajaran target (agar leaderboard
     * tahun ajaran aktif langsung terisi).
     */
    private function cloneKelasKeTahunAjaran(TahunAjaran $target): void
    {
        /** @var Collection<int, Collection<int, Kelas>> $perTahunAjaran */
        $perTahunAjaran = Kelas::where('tahun_ajaran_id', '!=', $target->id)
            ->get()
            ->groupBy('tahun_ajaran_id');

        $sumber = $perTahunAjaran->sortByDesc(fn ($g) => $g->count())->first();

        if (! $sumber) {
            $this->command?->warn(
                "Tidak ada kelas lain untuk di-clone ke TA {$target->tahun_ajaran}."
            );

            return;
        }

        $dokumenList = DokumenPerkuliahan::orderBy('id')->get();

        foreach ($sumber as $kelas) {
            $kelasBaru = Kelas::create([
                'nama_kelas' => $kelas->nama_kelas,
                'dosen_id' => $kelas->dosen_id,
                'matkul_dibuka_id' => $kelas->matkul_dibuka_id,
                'tahun_ajaran_id' => $target->id,
            ]);

            foreach ($dokumenList as $dokumen) {
                DokumenKelas::create([
                    'kelas_id' => $kelasBaru->id,
                    'dokumen_perkuliahan_id' => $dokumen->id,
                ]);
            }
        }

        $this->command?->info(
            'Clone '.count($sumber).' kelas (+ dokumen) ke TA '.$target->tahun_ajaran.'.'
        );
    }

    private function isiDummy(DokumenKelas $dokumenKelas, Carbon $deadline, ?int $dosenId): void
    {
        $profil = $this->profilDosen($dosenId);

        $batas = match ($profil) {
            'rajin' => ['tepat' => 70, 'terlambat' => 90],
            'sedang' => ['tepat' => 50, 'terlambat' => 80],
            default => ['tepat' => 25, 'terlambat' => 50],
        };

        // gulir deterministik per baris dokumen_kelas
        mt_srand((int) crc32('dk-' . $dokumenKelas->id . '-' . $dosenId));
        $gulir = mt_rand(1, 100);
        $ragam = mt_rand(1, 100);

        if ($gulir <= $batas['tepat']) {
            // 15% di antaranya mengumpulkan jauh lebih awal -> berpeluang bonus kecepatan
            if ($ragam <= 15) {
                $waktu = $deadline->copy()
                    ->subDays(mt_rand(3, 10))
                    ->subHours(mt_rand(0, 23));
            } else {
                $waktu = $deadline->copy()
                    ->subHours(mt_rand(1, 48))
                    ->subMinutes(mt_rand(0, 59));
            }

            $dokumenKelas->update([
                'status' => 'dikumpulkan',
                'waktu_pengumpulan' => $waktu->format('Y-m-d H:i:s'),
                'file_dokumen' => 'dokumen/dummy/dk-' . $dokumenKelas->id . '.pdf',
                'catatan' => null,
            ]);
        } elseif ($gulir <= $batas['terlambat']) {
            $waktu = $deadline->copy()->addHours(mt_rand(1, 96));

            $dokumenKelas->update([
                'status' => 'dikumpulkan',
                'waktu_pengumpulan' => $waktu->format('Y-m-d H:i:s'),
                'file_dokumen' => 'dokumen/dummy/dk-' . $dokumenKelas->id . '.pdf',
                'catatan' => null,
            ]);
        } else {
            // 30% dikirim lalu ditolak (tetap dihitung tidak terkumpul), sisanya tidak dikirim
            if ($ragam <= 30) {
                $catatan = [
                    'File tidak sesuai template resmi.',
                    'Dokumen tidak terbaca / file corrupt.',
                    'Tanda tangan dan kop belum diisi.',
                    'Isi dokumen tidak lengkap, mohon unggah ulang.',
                ][mt_rand(0, 3)];

                $dokumenKelas->update([
                    'status' => 'ditolak',
                    'waktu_pengumpulan' => $deadline->copy()->subHours(mt_rand(1, 36))->format('Y-m-d H:i:s'),
                    'file_dokumen' => 'dokumen/dummy/dk-' . $dokumenKelas->id . '.pdf',
                    'catatan' => $catatan,
                ]);
            }
            // selain itu: dibiarkan null -> "Tidak Terkumpul"
        }
    }

    private function profilDosen(?int $dosenId): string
    {
        mt_srand((int) crc32('profil-dosen-' . $dosenId));
        $gulir = mt_rand(1, 100);

        if ($gulir <= 40) {
            return 'rajin';
        }

        if ($gulir <= 75) {
            return 'sedang';
        }

        return 'malas';
    }
}

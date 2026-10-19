<?php

namespace Tests\Unit\Services;

use App\Models\DokumenKelas;
use App\Models\DokumenPerkuliahan;
use App\Models\Kelas;
use App\Models\Matkul;
use App\Models\MatkulDibuka;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use App\Models\User;
use App\Services\PemeringkatanDosenService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PemeringkatanDosenServiceTest extends TestCase
{
    use RefreshDatabase;

    private PemeringkatanDosenService $service;

    private Prodi $prodi;

    private TahunAjaran $tahunAjaran;

    private MatkulDibuka $matkulDibuka;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new PemeringkatanDosenService;

        $this->prodi = Prodi::create(['nama_prodi' => 'Teknik Informatika', 'kode_prodi' => 'TI']);

        $this->tahunAjaran = TahunAjaran::create([
            'tahun_ajaran' => '2025/2026',
            'jenis' => 'Ganjil',
            'tanggal_mulai_kuliah' => '2025-09-01',
            'is_aktif' => true,
        ]);

        $matkul = Matkul::create([
            'nama_matkul' => 'Pemrograman',
            'kode_matkul' => 'PW001',
            'bobot_sks' => 3,
            'praktikum' => false,
            'prodi_id' => $this->prodi->id,
        ]);

        $this->matkulDibuka = MatkulDibuka::create([
            'matkul_id' => $matkul->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
            'jumlah_kelas' => 10,
        ]);
    }

    // ---------------------------------------------------------------
    // HELPERS
    // ---------------------------------------------------------------

    private function dosen(string $nama, ?Prodi $prodi = null): User
    {
        return User::factory()->create([
            'name' => $nama,
            'prodi_id' => ($prodi ?? $this->prodi)->id,
        ]);
    }

    private function kelas(User $dosen, ?TahunAjaran $tahunAjaran = null): Kelas
    {
        $tahunAjaran = $tahunAjaran ?? $this->tahunAjaran;

        return Kelas::create([
            'nama_kelas' => 'Kelas '.$dosen->id.'-'.$tahunAjaran->id,
            'dosen_id' => $dosen->id,
            'matkul_dibuka_id' => $this->matkulDibuka->id,
            'tahun_ajaran_id' => $tahunAjaran->id,
        ]);
    }

    private function dokumen(string $nama, int $tenggatMinggu = 1): DokumenPerkuliahan
    {
        return DokumenPerkuliahan::create([
            'nama_dokumen' => $nama,
            'sesi' => 1,
            'tenggat_waktu_default' => $tenggatMinggu,
        ]);
    }

    private function tugas(Kelas $kelas, DokumenPerkuliahan $dokumen, ?string $waktu = null, ?string $status = 'dikumpulkan'): DokumenKelas
    {
        return DokumenKelas::create([
            'kelas_id' => $kelas->id,
            'dokumen_perkuliahan_id' => $dokumen->id,
            'file_dokumen' => $status === 'dikumpulkan' ? 'dokumen/'.$dokumen->id.'.pdf' : null,
            'waktu_pengumpulan' => $waktu,
            'status' => $status,
        ]);
    }

    /**
     * Buat 3 dosen pengumpul tercepat agar dosen yang diuji tidak
     * mendapat bonus kecepatan (peringkat ke-4 dan seterusnya).
     */
    private function tiga_pengumpul_lebih_cepat(DokumenPerkuliahan $dokumen, string $waktu = '2025-09-02 08:00:00'): void
    {
        foreach ([1, 2, 3] as $urut) {
            $dosen = $this->dosen('Pengumpul Cepat '.$urut);
            $kelas = $this->kelas($dosen);
            $this->tugas($kelas, $dokumen, $waktu);
            $waktu = date('Y-m-d H:i:s', strtotime($waktu) + 3600);
        }
    }

    private function leaderboard(?TahunAjaran $tahunAjaran = null, ?int $prodiId = null): array
    {
        $tahunAjaran = $tahunAjaran ?? $this->tahunAjaran;

        $kelasList = Kelas::with(['dosen.prodi', 'matkulDibuka.matkul.prodi', 'dokumenKelas.dokumenPerkuliahan'])
            ->where('tahun_ajaran_id', $tahunAjaran->id)
            ->get();

        return $this->service->hitung($kelasList, $tahunAjaran, $prodiId);
    }

    private function baris(array $leaderboard, User $dosen): array
    {
        foreach ($leaderboard as $baris) {
            if ($baris['dosen_id'] === $dosen->id) {
                return $baris;
            }
        }

        $this->fail('Dosen '.$dosen->name.' tidak ditemukan pada leaderboard.');
    }

    // ---------------------------------------------------------------
    // TEST 1 — TEPAT WAKTU
    // ---------------------------------------------------------------

    public function test_dokumen_tepat_waktu_mendapat_100_poin(): void
    {
        $dosen = $this->dosen('Dosen A');
        $kelas = $this->kelas($dosen);
        $dokumen = $this->dokumen('RPS');

        $this->tiga_pengumpul_lebih_cepat($dokumen);
        $this->tugas($kelas, $dokumen, '2025-09-05 10:00:00');

        $baris = $this->baris($this->leaderboard(), $dosen);

        $this->assertSame(100, $baris['total_poin']);
        $this->assertSame(1, $baris['tepat_waktu']);
        $this->assertSame(0, $baris['terlambat']);
        $this->assertSame(0, $baris['tidak_terkumpul']);
        $this->assertSame(100.0, $baris['score']);
        $this->assertSame(100.0, $baris['on_time_rate']);
    }

    public function test_pengumpulan_persis_pada_deadline_dihitung_tepat_waktu(): void
    {
        $dosen = $this->dosen('Dosen Batas');
        $kelas = $this->kelas($dosen);
        $dokumen = $this->dokumen('RPS');

        $this->tiga_pengumpul_lebih_cepat($dokumen);
        $this->tugas($kelas, $dokumen, '2025-09-08 23:59:59');

        $baris = $this->baris($this->leaderboard(), $dosen);

        $this->assertSame(100, $baris['total_poin']);
        $this->assertSame(1, $baris['tepat_waktu']);
    }

    public function test_deadline_dihitung_dari_tanggal_mulai_kuliah_ditambah_minggu(): void
    {
        $dokumen = $this->dokumen('RPS', 1);
        $deadline = $this->service->deadline($dokumen, $this->tahunAjaran);

        $this->assertSame('2025-09-08 23:59:59', $deadline->format('Y-m-d H:i:s'));

        $dokumenNegatif = $this->dokumen('Kontrak Kuliah', -1);
        $deadlineNegatif = $this->service->deadline($dokumenNegatif, $this->tahunAjaran);

        $this->assertSame('2025-08-25 23:59:59', $deadlineNegatif->format('Y-m-d H:i:s'));
    }

    // ---------------------------------------------------------------
    // TEST 2 — TERLAMBAT
    // ---------------------------------------------------------------

    public function test_dokumen_terlambat_mendapat_minus_25_poin(): void
    {
        $dosen = $this->dosen('Dosen B');
        $kelas = $this->kelas($dosen);
        $dokumen = $this->dokumen('RPS');

        $this->tiga_pengumpul_lebih_cepat($dokumen);
        $this->tugas($kelas, $dokumen, '2025-09-09 10:00:00');

        $baris = $this->baris($this->leaderboard(), $dosen);

        $this->assertSame(-25, $baris['total_poin']);
        $this->assertSame(0, $baris['tepat_waktu']);
        $this->assertSame(1, $baris['terlambat']);
        $this->assertSame(-25.0, $baris['score']);
        $this->assertSame(0.0, $baris['on_time_rate']);
    }

    public function test_dokumen_ditolak_dihitung_tidak_terkumpul(): void
    {
        $dosen = $this->dosen('Dosen Ditolak');
        $kelas = $this->kelas($dosen);
        $dokumen = $this->dokumen('RPS');

        $this->tugas($kelas, $dokumen, '2025-09-05 10:00:00', 'ditolak');

        $baris = $this->baris($this->leaderboard(), $dosen);

        $this->assertSame(-100, $baris['total_poin']);
        $this->assertSame(1, $baris['tidak_terkumpul']);
    }

    // ---------------------------------------------------------------
    // TEST 3 — TIDAK MENGUMPULKAN
    // ---------------------------------------------------------------

    public function test_dokumen_tidak_dikumpulkan_mendapat_minus_100_poin(): void
    {
        $dosen = $this->dosen('Dosen C');
        $kelas = $this->kelas($dosen);
        $dokumen = $this->dokumen('RPS');

        $this->tugas($kelas, $dokumen, null, null);

        $baris = $this->baris($this->leaderboard(), $dosen);

        $this->assertSame(-100, $baris['total_poin']);
        $this->assertSame(1, $baris['tidak_terkumpul']);
        $this->assertSame(-100.0, $baris['score']);
    }

    // ---------------------------------------------------------------
    // TEST 4 — BONUS KECEPATAN
    // ---------------------------------------------------------------

    public function test_bonus_kecepatan_diberikan_pada_3_pengumpul_tercepat(): void
    {
        $dokumen = $this->dokumen('RPS');

        $pengumpul = [];
        foreach ([
            'Tercepat 1' => '2025-09-02 08:00:00',
            'Tercepat 2' => '2025-09-02 08:10:00',
            'Tercepat 3' => '2025-09-02 08:30:00',
            'Keempat' => '2025-09-02 09:00:00',
        ] as $nama => $waktu) {
            $dosen = $this->dosen($nama);
            $kelas = $this->kelas($dosen);
            $this->tugas($kelas, $dokumen, $waktu);
            $pengumpul[$nama] = $dosen;
        }

        $leaderboard = $this->leaderboard();

        $this->assertSame(150, $this->baris($leaderboard, $pengumpul['Tercepat 1'])['total_poin']);
        $this->assertSame(130, $this->baris($leaderboard, $pengumpul['Tercepat 2'])['total_poin']);
        $this->assertSame(115, $this->baris($leaderboard, $pengumpul['Tercepat 3'])['total_poin']);
        $this->assertSame(100, $this->baris($leaderboard, $pengumpul['Keempat'])['total_poin']);
    }

    public function test_bonus_tidak_diberikan_kepada_lebih_dari_3_orang(): void
    {
        $dokumen = $this->dokumen('RPS');

        $pengumpul = [];
        foreach ([1, 2, 3, 4, 5] as $urut) {
            $dosen = $this->dosen('Pengumpul '.$urut);
            $kelas = $this->kelas($dosen);
            $this->tugas($kelas, $dokumen, sprintf('2025-09-02 0%d:00:00', $urut));
            $pengumpul[$urut] = $dosen;
        }

        $leaderboard = $this->leaderboard();

        $this->assertSame(150, $this->baris($leaderboard, $pengumpul[1])['total_poin']);
        $this->assertSame(130, $this->baris($leaderboard, $pengumpul[2])['total_poin']);
        $this->assertSame(115, $this->baris($leaderboard, $pengumpul[3])['total_poin']);
        $this->assertSame(100, $this->baris($leaderboard, $pengumpul[4])['total_poin']);
        $this->assertSame(100, $this->baris($leaderboard, $pengumpul[5])['total_poin']);
    }

    public function test_bonus_dihitung_per_dokumen_bukan_per_semester(): void
    {
        $dosen = $this->dosen('Dosen Juara');
        $kelas = $this->kelas($dosen);

        $dokumenA = $this->dokumen('RPS');
        $dokumenB = $this->dokumen('Kontrak Kuliah');

        $this->tugas($kelas, $dokumenA, '2025-09-02 08:00:00');
        $this->tugas($kelas, $dokumenB, '2025-09-02 09:00:00');

        $baris = $this->baris($this->leaderboard(), $dosen);

        // tercepat di kedua dokumen -> bonus 50 + 50
        $this->assertSame(300, $baris['total_poin']);
        $this->assertSame(150.0, $baris['score']);
    }

    public function test_dokumen_tidak_dikumpulkan_tidak_mendapat_bonus(): void
    {
        $dosen = $this->dosen('Dosen Kosong');
        $kelas = $this->kelas($dosen);
        $dokumen = $this->dokumen('RPS');

        $this->tugas($kelas, $dokumen, null, null);

        $baris = $this->baris($this->leaderboard(), $dosen);

        $this->assertSame(-100, $baris['total_poin']);
    }

    // ---------------------------------------------------------------
    // TEST 5 — SCORE = TOTAL POIN / JUMLAH TUGAS
    // ---------------------------------------------------------------

    public function test_score_dihitung_dari_total_poin_dibagi_jumlah_tugas(): void
    {
        $dosenA = $this->dosen('Dosen A');
        $kelasA = $this->kelas($dosenA);

        $kelasX = [];
        foreach ([1, 2, 3] as $urut) {
            $pembanding = $this->dosen('Pembanding '.$urut);
            $kelasX[$urut] = $this->kelas($pembanding);
        }

        $dokumen = [];
        foreach (range(1, 5) as $i) {
            $dokumen[$i] = $this->dokumen('Dokumen '.$i);
        }

        // Dokumen 1: Dosen A tercepat -> +50
        $this->tugas($kelasA, $dokumen[1], '2025-09-02 08:00:00');
        $this->tugas($kelasX[1], $dokumen[1], '2025-09-03 08:00:00');
        $this->tugas($kelasX[2], $dokumen[1], '2025-09-04 08:00:00');
        $this->tugas($kelasX[3], $dokumen[1], '2025-09-05 08:00:00');

        // Dokumen 2: Dosen A kedua -> +30
        $this->tugas($kelasX[1], $dokumen[2], '2025-09-02 07:00:00');
        $this->tugas($kelasA, $dokumen[2], '2025-09-03 09:00:00');
        $this->tugas($kelasX[2], $dokumen[2], '2025-09-04 07:00:00');
        $this->tugas($kelasX[3], $dokumen[2], '2025-09-05 07:00:00');

        // Dokumen 3: Dosen A ketiga -> +15
        $this->tugas($kelasX[1], $dokumen[3], '2025-09-02 07:00:00');
        $this->tugas($kelasX[2], $dokumen[3], '2025-09-02 07:30:00');
        $this->tugas($kelasA, $dokumen[3], '2025-09-03 09:00:00');
        $this->tugas($kelasX[3], $dokumen[3], '2025-09-04 09:00:00');

        // Dokumen 4: Dosen A keempat -> +0
        $this->tugas($kelasX[1], $dokumen[4], '2025-09-02 07:00:00');
        $this->tugas($kelasX[2], $dokumen[4], '2025-09-02 07:30:00');
        $this->tugas($kelasX[3], $dokumen[4], '2025-09-02 08:00:00');
        $this->tugas($kelasA, $dokumen[4], '2025-09-03 09:00:00');

        // Dokumen 5: Dosen A terlambat -> -25, tanpa bonus
        $this->tugas($kelasX[1], $dokumen[5], '2025-09-02 07:00:00');
        $this->tugas($kelasX[2], $dokumen[5], '2025-09-02 07:30:00');
        $this->tugas($kelasX[3], $dokumen[5], '2025-09-02 08:00:00');
        $this->tugas($kelasA, $dokumen[5], '2025-09-09 10:00:00');

        $baris = $this->baris($this->leaderboard(), $dosenA);

        // 150 + 130 + 115 + 100 - 25 = 470
        $this->assertSame(470, $baris['total_poin']);
        $this->assertSame(5, $baris['jumlah_tugas']);
        $this->assertSame(94.0, $baris['score']);
        $this->assertSame(4, $baris['tepat_waktu']);
        $this->assertSame(1, $baris['terlambat']);
        $this->assertSame(0, $baris['tidak_terkumpul']);
        $this->assertSame(80.0, $baris['on_time_rate']);
    }

    // ---------------------------------------------------------------
    // TEST 6 — TIE BREAKER (skor sama, on-time rate menentukan)
    // ---------------------------------------------------------------

    public function test_skor_sama_dengan_on_time_rate_berbeda_menentukan_urutan(): void
    {
        $dosenRendah = $this->dosen('Dosen Rate Rendah');
        $kelasRendah = $this->kelas($dosenRendah);
        $dokumenX = $this->dokumen('Dokumen X');
        // terlambat, satu-satunya pengumpul: -25 + bonus 50 = 25
        $this->tugas($kelasRendah, $dokumenX, '2025-09-10 10:00:00');

        $dosenTinggi = $this->dosen('Dosen Rate Tinggi');
        $kelasTinggi = $this->kelas($dosenTinggi);
        $dokumenY = $this->dokumen('Dokumen Y');
        $dokumenZ = $this->dokumen('Dokumen Z');
        // tepat waktu + bonus 50 = 150, satu dokumen tidak dikumpulkan = -100
        // total 50 / 2 tugas = 25.0 dengan on-time rate 50%
        $this->tugas($kelasTinggi, $dokumenY, '2025-09-02 08:00:00');
        $this->tugas($kelasTinggi, $dokumenZ, null, null);

        $leaderboard = $this->leaderboard();

        $barisRendah = $this->baris($leaderboard, $dosenRendah);
        $barisTinggi = $this->baris($leaderboard, $dosenTinggi);

        $this->assertSame(25.0, $barisRendah['score']);
        $this->assertSame(25.0, $barisTinggi['score']);
        $this->assertSame(0.0, $barisRendah['on_time_rate']);
        $this->assertSame(50.0, $barisTinggi['on_time_rate']);
        $this->assertLessThan($barisRendah['rank'], $barisTinggi['rank']);
    }

    // ---------------------------------------------------------------
    // TEST 7 — SKOR DAN RATE SAMA -> RANK SAMA (competition ranking)
    // ---------------------------------------------------------------

    public function test_skor_dan_rate_sama_mendapat_rank_sama(): void
    {
        $dosenA = $this->dosen('Dosen Tie A');
        $dosenB = $this->dosen('Dosen Tie B');
        $dosenC = $this->dosen('Dosen Di Bawah');

        $kelasA = $this->kelas($dosenA);
        $kelasB = $this->kelas($dosenB);
        $kelasC = $this->kelas($dosenC);

        // Dosen A & B: dua dokumen masing-masing, satu-satunya pengumpul
        // -> 150 + 150 = 300 / 2 = 150.0, on-time rate 100%
        foreach ([1, 2] as $i) {
            $this->tugas($kelasA, $this->dokumen('Dokumen A'.$i), '2025-09-02 08:00:00');
            $this->tugas($kelasB, $this->dokumen('Dokumen B'.$i), '2025-09-02 09:00:00');
        }

        // Dosen C: satu dokumen terlambat -> -25 + bonus 50 = 25 / 1 = 25.0
        $this->tugas($kelasC, $this->dokumen('Dokumen C1'), '2025-09-10 08:00:00');

        $leaderboard = $this->leaderboard();

        $barisA = $this->baris($leaderboard, $dosenA);
        $barisB = $this->baris($leaderboard, $dosenB);
        $barisC = $this->baris($leaderboard, $dosenC);

        $this->assertSame($barisA['score'], $barisB['score']);
        $this->assertSame($barisA['on_time_rate'], $barisB['on_time_rate']);
        $this->assertSame(1, $barisA['rank']);
        $this->assertSame(1, $barisB['rank']);
        $this->assertSame(3, $barisC['rank']);
    }

    public function test_rank_diurutkan_dari_score_terbesar(): void
    {
        $dosenA = $this->dosen('Dosen Atas');
        $dosenB = $this->dosen('Dosen Bawah');

        $dokumenA = $this->dokumen('Dokumen Atas');
        $dokumenB = $this->dokumen('Dokumen Bawah');

        $this->tugas($this->kelas($dosenA), $dokumenA, '2025-09-02 08:00:00');
        $this->tugas($this->kelas($dosenB), $dokumenB, null, null);

        $leaderboard = $this->leaderboard();

        $this->assertSame($dosenA->id, $leaderboard[0]['dosen_id']);
        $this->assertSame(1, $leaderboard[0]['rank']);
        $this->assertSame($dosenB->id, $leaderboard[1]['dosen_id']);
        $this->assertSame(2, $leaderboard[1]['rank']);
    }

    // ---------------------------------------------------------------
    // TEST 8 — TAHUN AJARAN TIDAK BERCAMPUR
    // ---------------------------------------------------------------

    public function test_data_tahun_ajaran_berbeda_tidak_bercampur(): void
    {
        $tahunAjaran2 = TahunAjaran::create([
            'tahun_ajaran' => '2026/2027',
            'jenis' => 'Ganjil',
            'tanggal_mulai_kuliah' => '2026-09-01',
            'is_aktif' => false,
        ]);

        $matkul2 = Matkul::create([
            'nama_matkul' => 'Algoritma',
            'kode_matkul' => 'AL001',
            'bobot_sks' => 3,
            'praktikum' => false,
            'prodi_id' => $this->prodi->id,
        ]);

        $matkulDibuka2 = MatkulDibuka::create([
            'matkul_id' => $matkul2->id,
            'tahun_ajaran_id' => $tahunAjaran2->id,
            'jumlah_kelas' => 1,
        ]);

        $dosen1 = $this->dosen('Dosen TA 1');
        $kelas1 = Kelas::create([
            'nama_kelas' => 'Kelas TA1',
            'dosen_id' => $dosen1->id,
            'matkul_dibuka_id' => $this->matkulDibuka->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
        ]);
        $this->tugas($kelas1, $this->dokumen('Dokumen TA1'), '2025-09-02 08:00:00');

        $dosen2 = $this->dosen('Dosen TA 2');
        $kelas2 = Kelas::create([
            'nama_kelas' => 'Kelas TA2',
            'dosen_id' => $dosen2->id,
            'matkul_dibuka_id' => $matkulDibuka2->id,
            'tahun_ajaran_id' => $tahunAjaran2->id,
        ]);
        $this->tugas($kelas2, $this->dokumen('Dokumen TA2'), null, null);

        $leaderboard1 = $this->leaderboard($this->tahunAjaran);
        $leaderboard2 = $this->leaderboard($tahunAjaran2);

        $dosen1Pada1 = collect($leaderboard1)->firstWhere('dosen_id', $dosen1->id);
        $dosen2Pada1 = collect($leaderboard1)->firstWhere('dosen_id', $dosen2->id);
        $dosen2Pada2 = collect($leaderboard2)->firstWhere('dosen_id', $dosen2->id);
        $dosen1Pada2 = collect($leaderboard2)->firstWhere('dosen_id', $dosen1->id);

        $this->assertNotNull($dosen1Pada1);
        $this->assertNull($dosen2Pada1);
        $this->assertNotNull($dosen2Pada2);
        $this->assertNull($dosen1Pada2);
    }

    // ---------------------------------------------------------------
    // FILTER PRODI
    // ---------------------------------------------------------------

    public function test_filter_prodi_hanya_menghitung_kelas_prodi_tersebut(): void
    {
        $prodiLain = Prodi::create(['nama_prodi' => 'Sistem Informasi', 'kode_prodi' => 'SI']);

        $matkulLain = Matkul::create([
            'nama_matkul' => 'Basis Data',
            'kode_matkul' => 'BD001',
            'bobot_sks' => 3,
            'praktikum' => false,
            'prodi_id' => $prodiLain->id,
        ]);

        $matkulDibukaLain = MatkulDibuka::create([
            'matkul_id' => $matkulLain->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
            'jumlah_kelas' => 1,
        ]);

        $dosenTI = $this->dosen('Dosen TI');
        $kelasTI = Kelas::create([
            'nama_kelas' => 'Kelas TI',
            'dosen_id' => $dosenTI->id,
            'matkul_dibuka_id' => $this->matkulDibuka->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
        ]);
        $this->tugas($kelasTI, $this->dokumen('Dokumen TI'), null, null);

        $dosenSI = $this->dosen('Dosen SI', $prodiLain);
        $kelasSI = Kelas::create([
            'nama_kelas' => 'Kelas SI',
            'dosen_id' => $dosenSI->id,
            'matkul_dibuka_id' => $matkulDibukaLain->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
        ]);
        $this->tugas($kelasSI, $this->dokumen('Dokumen SI'), null, null);

        $semua = $this->leaderboard();
        $this->assertCount(2, $semua);

        $hanyaTI = $this->leaderboard(null, $this->prodi->id);
        $this->assertCount(1, $hanyaTI);
        $this->assertSame($dosenTI->id, $hanyaTI[0]['dosen_id']);

        $hanyaSI = $this->leaderboard(null, $prodiLain->id);
        $this->assertCount(1, $hanyaSI);
        $this->assertSame($dosenSI->id, $hanyaSI[0]['dosen_id']);
    }
}

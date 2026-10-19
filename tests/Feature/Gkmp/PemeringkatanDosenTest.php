<?php

namespace Tests\Feature\Gkmp;

use App\Models\DokumenKelas;
use App\Models\DokumenPerkuliahan;
use App\Models\Kelas;
use App\Models\Matkul;
use App\Models\MatkulDibuka;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PemeringkatanDosenTest extends TestCase
{
    use RefreshDatabase;

    protected Prodi $prodiTI;

    protected Prodi $prodiSI;

    protected TahunAjaran $tahunAjaran;

    protected User $gkmp;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'view:pemeringkatan-dosen', 'guard_name' => 'web']);

        $roleGkmp = Role::create(['name' => 'gkmp', 'guard_name' => 'web']);
        $roleGkmp->givePermissionTo('view:pemeringkatan-dosen');

        $roleGkmf = Role::create(['name' => 'gkmf', 'guard_name' => 'web']);
        $roleGkmf->givePermissionTo('view:pemeringkatan-dosen');

        $this->prodiTI = Prodi::create(['nama_prodi' => 'Teknik Informatika', 'kode_prodi' => 'TI']);
        $this->prodiSI = Prodi::create(['nama_prodi' => 'Sistem Informasi', 'kode_prodi' => 'SI']);

        $this->tahunAjaran = TahunAjaran::create([
            'tahun_ajaran' => '2025/2026',
            'jenis' => 'Ganjil',
            'tanggal_mulai_kuliah' => '2025-09-01',
            'is_aktif' => true,
        ]);

        $this->gkmp = User::factory()->create(['prodi_id' => $this->prodiTI->id]);
        $this->gkmp->assignRole('gkmp');
    }

    private function matkulDibuka(Prodi $prodi, TahunAjaran $tahunAjaran): MatkulDibuka
    {
        $matkul = Matkul::create([
            'nama_matkul' => 'Mata Kuliah '.$prodi->kode_prodi.'-'.uniqid(),
            'kode_matkul' => 'MK'.uniqid(),
            'bobot_sks' => 3,
            'praktikum' => false,
            'prodi_id' => $prodi->id,
        ]);

        return MatkulDibuka::create([
            'matkul_id' => $matkul->id,
            'tahun_ajaran_id' => $tahunAjaran->id,
            'jumlah_kelas' => 1,
        ]);
    }

    private function dosenDenganKelas(string $nama, Prodi $prodi, TahunAjaran $tahunAjaran): User
    {
        $dosen = User::factory()->create([
            'name' => $nama,
            'nip' => '1980'.uniqid(),
            'prodi_id' => $prodi->id,
        ]);

        $kelas = Kelas::create([
            'nama_kelas' => 'Kelas '.$nama,
            'dosen_id' => $dosen->id,
            'matkul_dibuka_id' => $this->matkulDibuka($prodi, $tahunAjaran)->id,
            'tahun_ajaran_id' => $tahunAjaran->id,
        ]);

        $dokumen = DokumenPerkuliahan::create([
            'nama_dokumen' => 'Dokumen '.$nama,
            'sesi' => 1,
            'tenggat_waktu_default' => 1,
        ]);

        DokumenKelas::create([
            'kelas_id' => $kelas->id,
            'dokumen_perkuliahan_id' => $dokumen->id,
            'file_dokumen' => 'dokumen/'.$dosen->id.'.pdf',
            'waktu_pengumpulan' => '2025-09-05 10:00:00',
            'status' => 'dikumpulkan',
        ]);

        return $dosen;
    }

    public function test_unauthenticated_user_is_redirected_to_login(): void
    {
        $response = $this->get(route('gkmp.pemeringkatanDosen.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_user_without_permission_gets_403(): void
    {
        $dosen = User::factory()->create(['prodi_id' => $this->prodiTI->id]);
        $dosen->assignRole(Role::create(['name' => 'dosen', 'guard_name' => 'web']));

        $response = $this->actingAs($dosen)->get(route('gkmp.pemeringkatanDosen.index'));

        $response->assertForbidden();
    }

    public function test_gkmp_can_access_leaderboard(): void
    {
        $response = $this->actingAs($this->gkmp)->get(route('gkmp.pemeringkatanDosen.index'));

        $response->assertStatus(200);
        $response->assertViewIs('gkmp.pemeringkatan-dosen.index');
    }

    public function test_gkmp_only_sees_dosen_from_own_prodi(): void
    {
        $dosenTI = $this->dosenDenganKelas('Dosen Tanggung Jawab TI', $this->prodiTI, $this->tahunAjaran);
        $dosenSI = $this->dosenDenganKelas('Dosen Luar Prodi SI', $this->prodiSI, $this->tahunAjaran);

        $response = $this->actingAs($this->gkmp)->get(route('gkmp.pemeringkatanDosen.index'));

        $response->assertStatus(200);
        $response->assertSee($dosenTI->name);
        $response->assertDontSee($dosenSI->name);
    }

    public function test_gkmf_sees_all_prodi_and_can_filter_by_prodi(): void
    {
        $gkmf = User::factory()->create();
        $gkmf->assignRole('gkmf');

        $dosenTI = $this->dosenDenganKelas('Dosen TI Satu', $this->prodiTI, $this->tahunAjaran);
        $dosenSI = $this->dosenDenganKelas('Dosen SI Satu', $this->prodiSI, $this->tahunAjaran);

        $semua = $this->actingAs($gkmf)->get(route('gkmp.pemeringkatanDosen.index'));
        $semua->assertStatus(200);
        $semua->assertSee($dosenTI->name);
        $semua->assertSee($dosenSI->name);

        $filterSI = $this->actingAs($gkmf)->get(route('gkmp.pemeringkatanDosen.index', [
            'prodi' => $this->prodiSI->id,
        ]));
        $filterSI->assertStatus(200);
        $filterSI->assertSee($dosenSI->name);
        $filterSI->assertDontSee($dosenTI->name);
    }

    public function test_leaderboard_is_filtered_by_tahun_ajaran(): void
    {
        $gkmf = User::factory()->create();
        $gkmf->assignRole('gkmf');

        $tahunAjaran2 = TahunAjaran::create([
            'tahun_ajaran' => '2026/2027',
            'jenis' => 'Ganjil',
            'tanggal_mulai_kuliah' => '2026-09-01',
            'is_aktif' => false,
        ]);

        $dosenTA1 = $this->dosenDenganKelas('Dosen Pada TA 2025', $this->prodiTI, $this->tahunAjaran);
        $dosenTA2 = $this->dosenDenganKelas('Dosen Pada TA 2026', $this->prodiTI, $tahunAjaran2);

        $aktif = $this->actingAs($gkmf)->get(route('gkmp.pemeringkatanDosen.index'));
        $aktif->assertStatus(200);
        $aktif->assertSee($dosenTA1->name);
        $aktif->assertDontSee($dosenTA2->name);

        $lain = $this->actingAs($gkmf)->get(route('gkmp.pemeringkatanDosen.index', [
            'tahun_ajaran' => $tahunAjaran2->id,
        ]));
        $lain->assertStatus(200);
        $lain->assertSee($dosenTA2->name);
        $lain->assertDontSee($dosenTA1->name);
    }

    public function test_leaderboard_displays_score_and_statistics(): void
    {
        $dosen = $this->dosenDenganKelas('Dosen Statistik', $this->prodiTI, $this->tahunAjaran);

        $response = $this->actingAs($this->gkmp)->get(route('gkmp.pemeringkatanDosen.index'));

        $response->assertStatus(200);
        $response->assertSee($dosen->name);
        $response->assertSee('Score');
        $response->assertSee('Ketepatan Waktu');
        $response->assertSee('Terkumpul');
        $response->assertSee('Terlambat');
        $response->assertSee('Tidak Terkumpul');
        // 1 tugas tepat waktu + bonus pengumpul tercepat = 150 / 1 = 150.0
        $response->assertSee('150.0');
    }
}

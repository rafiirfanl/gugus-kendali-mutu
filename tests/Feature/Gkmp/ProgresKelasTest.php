<?php

namespace Tests\Feature\Gkmp;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Matkul;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\MatkulDibuka;
use App\Models\DokumenPerkuliahan;
use App\Models\DokumenKelas;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProgresKelasTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Prodi $prodi;
    protected TahunAjaran $tahunAjaran;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'view:progres-kelas', 'guard_name' => 'web']);

        $role = Role::create(['name' => 'gkmp', 'guard_name' => 'web']);
        $role->givePermissionTo('view:progres-kelas');

        $this->prodi = Prodi::create(['nama_prodi' => 'TI', 'kode_prodi' => 'TI']);
        $this->tahunAjaran = TahunAjaran::create([
            'tahun_ajaran' => '2025/2026',
            'jenis' => 'Ganjil',
            'tanggal_mulai_kuliah' => '2025-09-01',
            'is_aktif' => true,
        ]);

        $this->user = User::factory()->create(['prodi_id' => $this->prodi->id]);
        $this->user->assignRole('gkmp');
    }

    public function test_index_returns_200(): void
    {
        $response = $this->actingAs($this->user)->get(route('gkmp.progresKelas.index'));
        $response->assertStatus(200);
        $response->assertViewIs('gkmp.progres-kelas.index');
    }

    public function test_index_returns_empty_when_no_active_tahun_ajaran(): void
    {
        TahunAjaran::where('is_aktif', true)->update(['is_aktif' => false]);

        $response = $this->actingAs($this->user)->get(route('gkmp.progresKelas.index'));
        $response->assertStatus(200);
    }

    public function test_index_displays_kelas_list(): void
    {
        $matkul = Matkul::create([
            'nama_matkul' => 'Pemrograman',
            'kode_matkul' => 'PW001',
            'bobot_sks' => 3,
            'praktikum' => false,
            'prodi_id' => $this->prodi->id,
        ]);

        $matkulDibuka = MatkulDibuka::create([
            'matkul_id' => $matkul->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
            'jumlah_kelas' => 1,
        ]);

        $dosen = User::factory()->create(['prodi_id' => $this->prodi->id]);
        $kelas = Kelas::create([
            'nama_kelas' => 'TI-A',
            'dosen_id' => $dosen->id,
            'matkul_dibuka_id' => $matkulDibuka->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
        ]);

        $response = $this->actingAs($this->user)->get(route('gkmp.progresKelas.index'));
        $response->assertSee('TI-A');
    }

    public function test_detail_kelas_returns_200(): void
    {
        $matkul = Matkul::create([
            'nama_matkul' => 'Pemrograman',
            'kode_matkul' => 'PW001',
            'bobot_sks' => 3,
            'praktikum' => false,
            'prodi_id' => $this->prodi->id,
        ]);

        $matkulDibuka = MatkulDibuka::create([
            'matkul_id' => $matkul->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
            'jumlah_kelas' => 1,
        ]);

        $dosen = User::factory()->create(['prodi_id' => $this->prodi->id]);
        $kelas = Kelas::create([
            'nama_kelas' => 'TI-A',
            'dosen_id' => $dosen->id,
            'matkul_dibuka_id' => $matkulDibuka->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
        ]);

        $response = $this->actingAs($this->user)->get(route('gkmp.detailKelas.index', $kelas->id));
        $response->assertStatus(200);
        $response->assertViewIs('gkmp.progres-kelas.detail-kelas');
    }

    public function test_tolak_validates_required_fields(): void
    {
        $response = $this->actingAs($this->user)->post(route('gkmp.progres-kelas.tolak'), []);
        $response->assertSessionHasErrors(['dokumen_kelas_id', 'catatan']);
    }

    public function test_tolak_updates_status(): void
    {
        $matkul = Matkul::create([
            'nama_matkul' => 'Pemrograman',
            'kode_matkul' => 'PW001',
            'bobot_sks' => 3,
            'praktikum' => false,
            'prodi_id' => $this->prodi->id,
        ]);

        $matkulDibuka = MatkulDibuka::create([
            'matkul_id' => $matkul->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
            'jumlah_kelas' => 1,
        ]);

        $dosen = User::factory()->create(['prodi_id' => $this->prodi->id]);
        $kelas = Kelas::create([
            'nama_kelas' => 'TI-A',
            'dosen_id' => $dosen->id,
            'matkul_dibuka_id' => $matkulDibuka->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
        ]);

        $dokumenPerkuliahan = DokumenPerkuliahan::create([
            'nama_dokumen' => 'RPS',
            'sesi' => 1,
            'tenggat_waktu_default' => 7,
        ]);

        $dokumenKelas = DokumenKelas::create([
            'kelas_id' => $kelas->id,
            'dokumen_perkuliahan_id' => $dokumenPerkuliahan->id,
            'status' => 'dikumpulkan',
        ]);

        $response = $this->actingAs($this->user)->post(route('gkmp.progres-kelas.tolak'), [
            'dokumen_kelas_id' => $dokumenKelas->id,
            'catatan' => 'Dokumen tidak lengkap',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('dokumen_kelas', [
            'id' => $dokumenKelas->id,
            'status' => 'ditolak',
            'catatan' => 'Dokumen tidak lengkap',
        ]);
    }

    public function test_unauthenticated_user_cannot_access(): void
    {
        $response = $this->get(route('gkmp.progresKelas.index'));
        $response->assertRedirect(route('login'));
    }
}

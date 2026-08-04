<?php

namespace Tests\Feature\Dosen;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

class KelasDiampuTest extends TestCase
{
    use RefreshDatabase;

    protected User $dosen;
    protected Prodi $prodi;
    protected TahunAjaran $tahunAjaran;
    protected Kelas $kelas;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'view:kelas-diampu', 'guard_name' => 'web']);

        $role = Role::create(['name' => 'dosen', 'guard_name' => 'web']);
        $role->givePermissionTo('view:kelas-diampu');

        $this->prodi = Prodi::create(['nama_prodi' => 'TI', 'kode_prodi' => 'TI']);
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

        $matkulDibuka = MatkulDibuka::create([
            'matkul_id' => $matkul->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
            'jumlah_kelas' => 1,
        ]);

        $this->dosen = User::factory()->create(['prodi_id' => $this->prodi->id]);
        $this->dosen->assignRole('dosen');

        $this->kelas = Kelas::create([
            'nama_kelas' => 'TI-A',
            'dosen_id' => $this->dosen->id,
            'matkul_dibuka_id' => $matkulDibuka->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
        ]);
    }

    public function test_index_returns_200(): void
    {
        $response = $this->actingAs($this->dosen)->get(route('dosen.kelasDiampu.index'));
        $response->assertStatus(200);
        $response->assertViewIs('dosen.kelas-diampu.index');
    }

    public function test_index_displays_kelas(): void
    {
        $response = $this->actingAs($this->dosen)->get(route('dosen.kelasDiampu.index'));
        $response->assertSee('TI-A');
    }

    public function test_index_returns_empty_when_no_active_ta(): void
    {
        TahunAjaran::where('is_aktif', true)->update(['is_aktif' => false]);

        $response = $this->actingAs($this->dosen)->get(route('dosen.kelasDiampu.index'));
        $response->assertStatus(200);
    }

    public function test_show_returns_200(): void
    {
        $response = $this->actingAs($this->dosen)->get(route('dosen.kelasDiampu.show', $this->kelas->id));
        $response->assertStatus(200);
        $response->assertViewIs('dosen.kelas-diampu.submission');
    }

    public function test_upload_creates_file(): void
    {
        Storage::fake('public');

        $dokumenPerkuliahan = DokumenPerkuliahan::create([
            'nama_dokumen' => 'RPS',
            'sesi' => 1,
            'tenggat_waktu_default' => 7,
        ]);

        $dokumenKelas = DokumenKelas::create([
            'kelas_id' => $this->kelas->id,
            'dokumen_perkuliahan_id' => $dokumenPerkuliahan->id,
            'status' => 'ditolak',
        ]);

        $file = UploadedFile::fake()->create('dokumen.pdf', 100, 'application/pdf');

        $response = $this->actingAs($this->dosen)->post(route('dosen.kelasDiampu.upload', $dokumenKelas->id), [
            'file_dokumen' => $file,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('dokumen_kelas', [
            'id' => $dokumenKelas->id,
            'status' => 'dikumpulkan',
        ]);
    }

    public function test_upload_validates_file_type(): void
    {
        $dokumenPerkuliahan = DokumenPerkuliahan::create([
            'nama_dokumen' => 'RPS',
            'sesi' => 1,
            'tenggat_waktu_default' => 7,
        ]);

        $dokumenKelas = DokumenKelas::create([
            'kelas_id' => $this->kelas->id,
            'dokumen_perkuliahan_id' => $dokumenPerkuliahan->id,
            'status' => 'ditolak',
        ]);

        $file = UploadedFile::fake()->create('malware.exe', 100, 'application/octet-stream');

        $response = $this->actingAs($this->dosen)->post(route('dosen.kelasDiampu.upload', $dokumenKelas->id), [
            'file_dokumen' => $file,
        ]);

        $response->assertSessionHasErrors(['file_dokumen']);
    }

    public function test_unauthenticated_user_cannot_access(): void
    {
        $response = $this->get(route('dosen.kelasDiampu.index'));
        $response->assertRedirect(route('login'));
    }
}

<?php

namespace Tests\Feature\Dosen;

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

class RiwayatDokumenTest extends TestCase
{
    use RefreshDatabase;

    protected User $dosen;
    protected Prodi $prodi;
    protected TahunAjaran $tahunAjaran;
    protected Kelas $kelas;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'view:riwayat-dokumen', 'guard_name' => 'web']);

        $role = Role::create(['name' => 'dosen', 'guard_name' => 'web']);
        $role->givePermissionTo('view:riwayat-dokumen');

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
        $response = $this->actingAs($this->dosen)->get(route('dosen.riwayatDokumen.index'));
        $response->assertStatus(200);
        $response->assertViewIs('dosen.riwayat-dokumen.index');
    }

    public function test_index_displays_riwayat(): void
    {
        $dokumenPerkuliahan = DokumenPerkuliahan::create([
            'nama_dokumen' => 'RPS',
            'sesi' => 1,
            'tenggat_waktu_default' => 7,
        ]);

        DokumenKelas::create([
            'kelas_id' => $this->kelas->id,
            'dokumen_perkuliahan_id' => $dokumenPerkuliahan->id,
            'file_dokumen' => 'dokumen/rps.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
        ]);

        $response = $this->actingAs($this->dosen)->get(route('dosen.riwayatDokumen.index'));
        $response->assertSee('RPS');
    }

    public function test_index_with_search(): void
    {
        $dokumenPerkuliahan = DokumenPerkuliahan::create([
            'nama_dokumen' => 'Absensi',
            'sesi' => 1,
            'tenggat_waktu_default' => 3,
        ]);

        DokumenKelas::create([
            'kelas_id' => $this->kelas->id,
            'dokumen_perkuliahan_id' => $dokumenPerkuliahan->id,
            'file_dokumen' => 'dokumen/absensi.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
        ]);

        $response = $this->actingAs($this->dosen)->get(route('dosen.riwayatDokumen.index'), [
            'search' => 'Absensi',
        ]);

        $response->assertStatus(200);
        $response->assertSee('Absensi');
    }

    public function test_index_search_no_results(): void
    {
        $response = $this->actingAs($this->dosen)->get(route('dosen.riwayatDokumen.index'), [
            'search' => 'nonexistent',
        ]);

        $response->assertStatus(200);
    }

    public function test_index_shows_only_own_riwayat(): void
    {
        $otherDosen = User::factory()->create(['prodi_id' => $this->prodi->id]);
        $otherDosen->assignRole('dosen');

        $otherKelas = Kelas::create([
            'nama_kelas' => 'TI-B',
            'dosen_id' => $otherDosen->id,
            'matkul_dibuka_id' => $this->kelas->matkul_dibuka_id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
        ]);

        $dokumenPerkuliahan = DokumenPerkuliahan::create([
            'nama_dokumen' => 'RPS',
            'sesi' => 1,
            'tenggat_waktu_default' => 7,
        ]);

        DokumenKelas::create([
            'kelas_id' => $otherKelas->id,
            'dokumen_perkuliahan_id' => $dokumenPerkuliahan->id,
            'status' => 'dikumpulkan',
        ]);

        $response = $this->actingAs($this->dosen)->get(route('dosen.riwayatDokumen.index'));
        $response->assertDontSee('TI-B');
    }

    public function test_unauthenticated_user_cannot_access(): void
    {
        $response = $this->get(route('dosen.riwayatDokumen.index'));
        $response->assertRedirect(route('login'));
    }
}

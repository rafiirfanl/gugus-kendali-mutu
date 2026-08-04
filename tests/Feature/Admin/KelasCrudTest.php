<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Matkul;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\MatkulDibuka;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class KelasCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Prodi $prodi;
    protected TahunAjaran $tahunAjaran;
    protected MatkulDibuka $matkulDibuka;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'view:kelas', 'guard_name' => 'web']);
        Permission::create(['name' => 'create:kelas', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit:kelas', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete:kelas', 'guard_name' => 'web']);

        $role = Role::create(['name' => 'gkmf', 'guard_name' => 'web']);
        $role->givePermissionTo(['view:kelas', 'create:kelas', 'edit:kelas', 'delete:kelas']);

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

        $this->matkulDibuka = MatkulDibuka::create([
            'matkul_id' => $matkul->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
            'jumlah_kelas' => 2,
        ]);

        $this->user = User::factory()->create(['prodi_id' => $this->prodi->id]);
        $this->user->assignRole('gkmf');
    }

    public function test_index_returns_200(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.kelas.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.kelas.index');
    }

    public function test_store_creates_kelas(): void
    {
        $dosen = User::factory()->create(['prodi_id' => $this->prodi->id]);

        $response = $this->actingAs($this->user)->post(route('admin.kelas.store'), [
            'nama_kelas' => 'TI-A',
            'matkul_dibuka_id' => $this->matkulDibuka->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
            'dosen_id' => $dosen->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('kelas', ['nama_kelas' => 'TI-A']);
    }

    public function test_store_validates_required_fields(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.kelas.store'), []);
        $response->assertSessionHasErrors(['nama_kelas', 'matkul_dibuka_id', 'tahun_ajaran_id', 'dosen_id']);
    }

    public function test_update_modifies_kelas(): void
    {
        $dosen = User::factory()->create(['prodi_id' => $this->prodi->id]);
        $kelas = Kelas::create([
            'nama_kelas' => 'Old Class',
            'matkul_dibuka_id' => $this->matkulDibuka->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
            'dosen_id' => $dosen->id,
        ]);

        $response = $this->actingAs($this->user)->put(route('admin.kelas.update', $kelas), [
            'nama_kelas' => 'Updated Class',
            'matkul_dibuka_id' => $this->matkulDibuka->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
            'dosen_id' => $dosen->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('kelas', ['nama_kelas' => 'Updated Class']);
    }

    public function test_destroy_removes_kelas(): void
    {
        $dosen = User::factory()->create(['prodi_id' => $this->prodi->id]);
        $kelas = Kelas::create([
            'nama_kelas' => 'To Delete',
            'matkul_dibuka_id' => $this->matkulDibuka->id,
            'tahun_ajaran_id' => $this->tahunAjaran->id,
            'dosen_id' => $dosen->id,
        ]);

        $response = $this->actingAs($this->user)->delete(route('admin.kelas.destroy', $kelas));
        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('kelas', ['id' => $kelas->id]);
    }

    public function test_unauthenticated_user_cannot_access(): void
    {
        $response = $this->get(route('admin.kelas.index'));
        $response->assertRedirect(route('login'));
    }
}

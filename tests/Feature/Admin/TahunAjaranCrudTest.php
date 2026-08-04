<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\TahunAjaran;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TahunAjaranCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'view:tahun-ajaran', 'guard_name' => 'web']);
        Permission::create(['name' => 'create:tahun-ajaran', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit:tahun-ajaran', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete:tahun-ajaran', 'guard_name' => 'web']);

        $role = Role::create(['name' => 'gkmf', 'guard_name' => 'web']);
        $role->givePermissionTo(['view:tahun-ajaran', 'create:tahun-ajaran', 'edit:tahun-ajaran', 'delete:tahun-ajaran']);

        $this->user = User::factory()->create();
        $this->user->assignRole('gkmf');
    }

    public function test_index_returns_200(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.tahunAjaran.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.tahun-ajaran.index');
    }

    public function test_index_displays_tahun_ajaran(): void
    {
        TahunAjaran::create([
            'tahun_ajaran' => '2025/2026',
            'jenis' => 'Ganjil',
            'tanggal_mulai_kuliah' => '2025-09-01',
            'is_aktif' => true,
        ]);

        $response = $this->actingAs($this->user)->get(route('admin.tahunAjaran.index'));
        $response->assertSee('2025/2026');
    }

    public function test_store_creates_tahun_ajaran(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.tahunAjaran.store'), [
            'tahun1' => '2025',
            'tahun2' => '2026',
            'jenis' => 'Ganjil',
            'tanggal_mulai_kuliah' => '2025-09-01',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('tahun_ajarans', [
            'tahun_ajaran' => '2025/2026',
            'jenis' => 'Ganjil',
            'is_aktif' => true,
        ]);
    }

    public function test_store_deactivates_old_tahun_ajaran(): void
    {
        TahunAjaran::create([
            'tahun_ajaran' => '2024/2025',
            'jenis' => 'Ganjil',
            'tanggal_mulai_kuliah' => '2024-09-01',
            'is_aktif' => true,
        ]);

        $this->actingAs($this->user)->post(route('admin.tahunAjaran.store'), [
            'tahun1' => '2025',
            'tahun2' => '2026',
            'jenis' => 'Genap',
            'tanggal_mulai_kuliah' => '2026-02-01',
        ]);

        $this->assertDatabaseHas('tahun_ajarans', ['tahun_ajaran' => '2024/2025', 'is_aktif' => false]);
        $this->assertDatabaseHas('tahun_ajarans', ['tahun_ajaran' => '2025/2026', 'is_aktif' => true]);
    }

    public function test_store_validates_required_fields(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.tahunAjaran.store'), []);
        $response->assertSessionHasErrors(['tahun1', 'tahun2', 'jenis', 'tanggal_mulai_kuliah']);
    }

    public function test_store_validates_jenis_values(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.tahunAjaran.store'), [
            'tahun1' => '2025',
            'tahun2' => '2026',
            'jenis' => 'Invalid',
            'tanggal_mulai_kuliah' => '2025-09-01',
        ]);

        $response->assertSessionHasErrors(['jenis']);
    }

    public function test_update_modifies_tahun_ajaran(): void
    {
        $ta = TahunAjaran::create([
            'tahun_ajaran' => '2025/2026',
            'jenis' => 'Ganjil',
            'tanggal_mulai_kuliah' => '2025-09-01',
            'is_aktif' => true,
        ]);

        $response = $this->actingAs($this->user)->put(route('admin.tahunAjaran.update', $ta), [
            'tahun1' => '2025',
            'tahun2' => '2027',
            'jenis' => 'Genap',
            'tanggal_mulai_kuliah' => '2026-02-01',
            'is_aktif' => false,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('tahun_ajarans', ['jenis' => 'Genap']);
    }

    public function test_destroy_removes_tahun_ajaran(): void
    {
        $ta = TahunAjaran::create([
            'tahun_ajaran' => '2025/2026',
            'jenis' => 'Ganjil',
            'tanggal_mulai_kuliah' => '2025-09-01',
            'is_aktif' => true,
        ]);

        $response = $this->actingAs($this->user)->delete(route('admin.tahunAjaran.destroy', $ta));
        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('tahun_ajarans', ['id' => $ta->id]);
    }

    public function test_unauthenticated_user_cannot_access(): void
    {
        $response = $this->get(route('admin.tahunAjaran.index'));
        $response->assertRedirect(route('login'));
    }
}

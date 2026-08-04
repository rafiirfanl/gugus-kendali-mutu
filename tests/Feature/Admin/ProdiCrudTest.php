<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Prodi;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProdiCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'view:prodi', 'guard_name' => 'web']);
        Permission::create(['name' => 'create:prodi', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit:prodi', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete:prodi', 'guard_name' => 'web']);

        $role = Role::create(['name' => 'gkmf', 'guard_name' => 'web']);
        $role->givePermissionTo(['view:prodi', 'create:prodi', 'edit:prodi', 'delete:prodi']);

        $this->user = User::factory()->create();
        $this->user->assignRole('gkmf');
    }

    public function test_index_returns_200(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.prodi.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.prodi.index');
    }

    public function test_index_displays_prodis(): void
    {
        Prodi::create(['nama_prodi' => 'Teknik Informatika', 'kode_prodi' => 'TI']);

        $response = $this->actingAs($this->user)->get(route('admin.prodi.index'));
        $response->assertSee('Teknik Informatika');
    }

    public function test_store_creates_prodi(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.prodi.store'), [
            'nama_prodi' => 'Sistem Informasi',
            'kode_prodi' => 'SI',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('prodis', ['kode_prodi' => 'SI']);
    }

    public function test_store_validates_required_fields(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.prodi.store'), []);
        $response->assertSessionHasErrors(['nama_prodi', 'kode_prodi']);
    }

    public function test_store_validates_unique_kode_prodi(): void
    {
        Prodi::create(['nama_prodi' => 'TI', 'kode_prodi' => 'TI']);

        $response = $this->actingAs($this->user)->post(route('admin.prodi.store'), [
            'nama_prodi' => 'TI Lain',
            'kode_prodi' => 'TI',
        ]);

        $response->assertSessionHasErrors(['kode_prodi']);
    }

    public function test_update_modifies_prodi(): void
    {
        $prodi = Prodi::create(['nama_prodi' => 'TI', 'kode_prodi' => 'TI']);

        $response = $this->actingAs($this->user)->put(route('admin.prodi.update', $prodi), [
            'nama_prodi' => 'Teknik Informatika Updated',
            'kode_prodi' => 'TI',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('prodis', ['nama_prodi' => 'Teknik Informatika Updated']);
    }

    public function test_update_validates_required_fields(): void
    {
        $prodi = Prodi::create(['nama_prodi' => 'TI', 'kode_prodi' => 'TI']);

        $response = $this->actingAs($this->user)->put(route('admin.prodi.update', $prodi), []);
        $response->assertSessionHasErrors(['nama_prodi', 'kode_prodi']);
    }

    public function test_destroy_removes_prodi(): void
    {
        $prodi = Prodi::create(['nama_prodi' => 'TI', 'kode_prodi' => 'TI']);

        $response = $this->actingAs($this->user)->delete(route('admin.prodi.destroy', $prodi));
        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('prodis', ['id' => $prodi->id]);
    }

    public function test_unauthenticated_user_cannot_access(): void
    {
        $response = $this->get(route('admin.prodi.index'));
        $response->assertRedirect(route('login'));
    }
}

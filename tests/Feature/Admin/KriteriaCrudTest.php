<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\HasilTemuan;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class KriteriaCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'view:temuan', 'guard_name' => 'web']);
        Permission::create(['name' => 'create:temuan', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit:temuan', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete:temuan', 'guard_name' => 'web']);

        $role = Role::create(['name' => 'gkmf', 'guard_name' => 'web']);
        $role->givePermissionTo(['view:temuan', 'create:temuan', 'edit:temuan', 'delete:temuan']);

        $this->user = User::factory()->create();
        $this->user->assignRole('gkmf');
    }

    public function test_index_returns_200(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.temuan.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.data-temuan.kriteria.index');
    }

    public function test_index_displays_kriteria(): void
    {
        Kriteria::create(['nama' => 'Kepemimpinan']);

        $response = $this->actingAs($this->user)->get(route('admin.temuan.index'));
        $response->assertSee('Kepemimpinan');
    }

    public function test_create_returns_view(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.temuan.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.data-temuan.kriteria.create');
    }

    public function test_store_creates_kriteria(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.temuan.store'), [
            'nama' => 'Mutu Pendidikan',
        ]);

        $response->assertRedirect(route('admin.temuan.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('kriterias', ['nama' => 'Mutu Pendidikan']);
    }

    public function test_store_validates_required_fields(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.temuan.store'), []);
        $response->assertSessionHasErrors(['nama']);
    }

    public function test_store_validates_unique_nama(): void
    {
        Kriteria::create(['nama' => 'Existing Kriteria']);

        $response = $this->actingAs($this->user)->post(route('admin.temuan.store'), [
            'nama' => 'Existing Kriteria',
        ]);

        $response->assertSessionHasErrors(['nama']);
    }

    public function test_show_returns_view(): void
    {
        $kriteria = Kriteria::create(['nama' => 'Show Test']);

        $response = $this->actingAs($this->user)->get(route('admin.temuan.show', $kriteria));
        $response->assertStatus(200);
        $response->assertViewIs('admin.data-temuan.kriteria.show');
    }

    public function test_edit_returns_view(): void
    {
        $kriteria = Kriteria::create(['nama' => 'Edit Test']);

        $response = $this->actingAs($this->user)->get(route('admin.temuan.edit', $kriteria));
        $response->assertStatus(200);
        $response->assertViewIs('admin.data-temuan.kriteria.edit');
    }

    public function test_update_modifies_kriteria(): void
    {
        $kriteria = Kriteria::create(['nama' => 'Old Name']);

        $response = $this->actingAs($this->user)->put(route('admin.temuan.update', $kriteria), [
            'nama' => 'Updated Name',
        ]);

        $response->assertRedirect(route('admin.temuan.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('kriterias', ['nama' => 'Updated Name']);
    }

    public function test_update_validates_required_fields(): void
    {
        $kriteria = Kriteria::create(['nama' => 'Test']);

        $response = $this->actingAs($this->user)->put(route('admin.temuan.update', $kriteria), []);
        $response->assertSessionHasErrors(['nama']);
    }

    public function test_destroy_removes_kriteria(): void
    {
        $kriteria = Kriteria::create(['nama' => 'To Delete']);

        $response = $this->actingAs($this->user)->delete(route('admin.temuan.destroy', $kriteria));
        $response->assertRedirect(route('admin.temuan.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('kriterias', ['id' => $kriteria->id]);
    }

    public function test_unauthenticated_user_cannot_access(): void
    {
        $response = $this->get(route('admin.temuan.index'));
        $response->assertRedirect(route('login'));
    }
}

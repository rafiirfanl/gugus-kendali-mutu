<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Matkul;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MatkulCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Prodi $prodi;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'view:matkul', 'guard_name' => 'web']);
        Permission::create(['name' => 'create:matkul', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit:matkul', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete:matkul', 'guard_name' => 'web']);

        $role = Role::create(['name' => 'gkmf', 'guard_name' => 'web']);
        $role->givePermissionTo(['view:matkul', 'create:matkul', 'edit:matkul', 'delete:matkul']);

        $this->prodi = Prodi::create(['nama_prodi' => 'TI', 'kode_prodi' => 'TI']);
        $this->user = User::factory()->create(['prodi_id' => $this->prodi->id]);
        $this->user->assignRole('gkmf');
    }

    public function test_index_returns_200(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.matkul.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.matkul.index');
    }

    public function test_index_displays_matkuls(): void
    {
        Matkul::create([
            'nama_matkul' => 'Pemrograman Web',
            'kode_matkul' => 'PW001',
            'bobot_sks' => 3,
            'praktikum' => false,
            'prodi_id' => $this->prodi->id,
        ]);

        $response = $this->actingAs($this->user)->get(route('admin.matkul.index'));
        $response->assertSee('Pemrograman Web');
    }

    public function test_store_creates_matkul(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.matkul.store'), [
            'nama_matkul' => 'Basis Data',
            'kode_matkul' => 'BD001',
            'bobot_sks' => 3,
            'praktikum' => true,
            'prodi_id' => $this->prodi->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('matkuls', ['kode_matkul' => 'BD001']);
    }

    public function test_store_validates_required_fields(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.matkul.store'), []);
        $response->assertSessionHasErrors(['nama_matkul', 'kode_matkul', 'bobot_sks', 'praktikum', 'prodi_id']);
    }

    public function test_store_validates_unique_kode_matkul(): void
    {
        Matkul::create([
            'nama_matkul' => 'Existing',
            'kode_matkul' => 'EX001',
            'bobot_sks' => 3,
            'praktikum' => false,
            'prodi_id' => $this->prodi->id,
        ]);

        $response = $this->actingAs($this->user)->post(route('admin.matkul.store'), [
            'nama_matkul' => 'New',
            'kode_matkul' => 'EX001',
            'bobot_sks' => 3,
            'praktikum' => false,
            'prodi_id' => $this->prodi->id,
        ]);

        $response->assertSessionHasErrors(['kode_matkul']);
    }

    public function test_update_modifies_matkul(): void
    {
        $matkul = Matkul::create([
            'nama_matkul' => 'Old Name',
            'kode_matkul' => 'OLD001',
            'bobot_sks' => 3,
            'praktikum' => false,
            'prodi_id' => $this->prodi->id,
        ]);

        $response = $this->actingAs($this->user)->put(route('admin.matkul.update', $matkul), [
            'nama_matkul' => 'Updated Name',
            'kode_matkul' => 'OLD001',
            'bobot_sks' => 4,
            'praktikum' => true,
            'prodi_id' => $this->prodi->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('matkuls', ['nama_matkul' => 'Updated Name', 'bobot_sks' => 4]);
    }

    public function test_destroy_removes_matkul(): void
    {
        $matkul = Matkul::create([
            'nama_matkul' => 'To Delete',
            'kode_matkul' => 'DEL001',
            'bobot_sks' => 3,
            'praktikum' => false,
            'prodi_id' => $this->prodi->id,
        ]);

        $response = $this->actingAs($this->user)->delete(route('admin.matkul.destroy', $matkul));
        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('matkuls', ['id' => $matkul->id]);
    }

    public function test_unauthenticated_user_cannot_access(): void
    {
        $response = $this->get(route('admin.matkul.index'));
        $response->assertRedirect(route('login'));
    }
}

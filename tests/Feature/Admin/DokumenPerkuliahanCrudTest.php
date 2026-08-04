<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\DokumenPerkuliahan;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DokumenPerkuliahanCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'view:dokumen-perkuliahan', 'guard_name' => 'web']);
        Permission::create(['name' => 'create:dokumen-perkuliahan', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit:dokumen-perkuliahan', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete:dokumen-perkuliahan', 'guard_name' => 'web']);

        $role = Role::create(['name' => 'gkmf', 'guard_name' => 'web']);
        $role->givePermissionTo([
            'view:dokumen-perkuliahan',
            'create:dokumen-perkuliahan',
            'edit:dokumen-perkuliahan',
            'delete:dokumen-perkuliahan',
        ]);

        $this->user = User::factory()->create();
        $this->user->assignRole('gkmf');
    }

    public function test_index_returns_200(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.dokumenPerkuliahan.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.dokumen-perkuliahan.index');
    }

    public function test_index_displays_dokumen(): void
    {
        DokumenPerkuliahan::create([
            'nama_dokumen' => 'RPS',
            'sesi' => 1,
            'tenggat_waktu_default' => 7,
        ]);

        $response = $this->actingAs($this->user)->get(route('admin.dokumenPerkuliahan.index'));
        $response->assertSee('RPS');
    }

    public function test_store_creates_dokumen_perkuliahan(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.dokumenPerkuliahan.store'), [
            'nama_dokumen' => 'Absensi',
            'sesi' => 1,
            'tenggat_waktu_default' => 3,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('dokumen_perkuliahans', ['nama_dokumen' => 'Absensi']);
    }

    public function test_store_with_template_file(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('template.pdf', 100, 'application/pdf');

        $this->actingAs($this->user)->post(route('admin.dokumenPerkuliahan.store'), [
            'nama_dokumen' => 'Template Doc',
            'sesi' => 2,
            'tenggat_waktu_default' => 7,
            'template' => $file,
        ]);

        $this->assertDatabaseHas('dokumen_perkuliahans', ['nama_dokumen' => 'Template Doc']);
    }

    public function test_store_validates_required_fields(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.dokumenPerkuliahan.store'), []);
        $response->assertSessionHasErrors(['nama_dokumen', 'sesi', 'tenggat_waktu_default']);
    }

    public function test_update_modifies_dokumen_perkuliahan(): void
    {
        $dokumen = DokumenPerkuliahan::create([
            'nama_dokumen' => 'Old Name',
            'sesi' => 1,
            'tenggat_waktu_default' => 7,
        ]);

        $response = $this->actingAs($this->user)->put(route('admin.dokumenPerkuliahan.update', $dokumen), [
            'nama_dokumen' => 'Updated Name',
            'sesi' => 2,
            'tenggat_waktu_default' => 14,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('dokumen_perkuliahans', ['nama_dokumen' => 'Updated Name']);
    }

    public function test_destroy_removes_dokumen_perkuliahan(): void
    {
        $dokumen = DokumenPerkuliahan::create([
            'nama_dokumen' => 'To Delete',
            'sesi' => 1,
            'tenggat_waktu_default' => 7,
        ]);

        $response = $this->actingAs($this->user)->delete(route('admin.dokumenPerkuliahan.destroy', $dokumen));
        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('dokumen_perkuliahans', ['id' => $dokumen->id]);
    }

    public function test_unauthenticated_user_cannot_access(): void
    {
        $response = $this->get(route('admin.dokumenPerkuliahan.index'));
        $response->assertRedirect(route('login'));
    }
}

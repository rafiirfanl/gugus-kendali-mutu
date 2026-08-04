<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Prodi;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Prodi $prodi;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'view:user', 'guard_name' => 'web']);
        Permission::create(['name' => 'create:user', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit:user', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete:user', 'guard_name' => 'web']);

        Role::create(['name' => 'gkmf', 'guard_name' => 'web']);
        Role::create(['name' => 'dosen', 'guard_name' => 'web']);
        Role::create(['name' => 'gkmp', 'guard_name' => 'web']);
        Role::create(['name' => 'kaprodi', 'guard_name' => 'web']);

        $role = Role::where('name', 'gkmf')->first();
        $role->givePermissionTo(['view:user', 'create:user', 'edit:user', 'delete:user']);

        $this->prodi = Prodi::create(['nama_prodi' => 'TI', 'kode_prodi' => 'TI']);
        $this->user = User::factory()->create(['prodi_id' => $this->prodi->id]);
        $this->user->assignRole('gkmf');
    }

    public function test_index_returns_200(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.user.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.user.index');
    }

    public function test_index_displays_users(): void
    {
        $dosenUser = User::factory()->create([
            'name' => 'Test GKMP',
            'prodi_id' => $this->prodi->id,
        ]);
        $dosenUser->assignRole('gkmp');

        $response = $this->actingAs($this->user)->get(route('admin.user.index'));
        $response->assertSee('Test GKMP');
    }

    public function test_store_creates_user(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.user.store'), [
            'name' => 'New Dosen',
            'email' => 'dosen@example.com',
            'nip' => '1234567890',
            'password' => 'password123',
            'role' => 'dosen',
            'email_verified' => '1',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('users', ['email' => 'dosen@example.com']);
    }

    public function test_store_assigns_role(): void
    {
        $this->actingAs($this->user)->post(route('admin.user.store'), [
            'name' => 'Role User',
            'email' => 'role@example.com',
            'nip' => '1234567890',
            'password' => 'password123',
            'role' => 'dosen',
            'email_verified' => '0',
        ]);

        $createdUser = User::where('email', 'role@example.com')->first();
        $this->assertTrue($createdUser->hasRole('dosen'));
    }

    public function test_store_validates_required_fields(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.user.store'), []);
        $response->assertSessionHasErrors(['name', 'email', 'nip', 'password', 'role', 'email_verified']);
    }

    public function test_store_validates_unique_email(): void
    {
        User::factory()->create(['email' => 'existing@example.com']);

        $response = $this->actingAs($this->user)->post(route('admin.user.store'), [
            'name' => 'Duplicate',
            'email' => 'existing@example.com',
            'nip' => '1234567890',
            'password' => 'password123',
            'role' => 'dosen',
            'email_verified' => '0',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_update_modifies_user(): void
    {
        $targetUser = User::factory()->create(['name' => 'Old Name']);

        $response = $this->actingAs($this->user)->put(route('admin.user.update', $targetUser), [
            'name' => 'Updated Name',
            'email' => $targetUser->email,
            'role' => 'dosen',
            'email_verified' => '1',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('users', ['name' => 'Updated Name']);
    }

    public function test_update_syncs_role(): void
    {
        $targetUser = User::factory()->create();
        $targetUser->assignRole('dosen');

        $this->actingAs($this->user)->put(route('admin.user.update', $targetUser), [
            'name' => $targetUser->name,
            'email' => $targetUser->email,
            'role' => 'gkmp',
            'email_verified' => '0',
        ]);

        $targetUser->refresh();
        $this->assertTrue($targetUser->hasRole('gkmp'));
        $this->assertFalse($targetUser->hasRole('dosen'));
    }

    public function test_destroy_removes_user(): void
    {
        $targetUser = User::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('admin.user.destroy', $targetUser));
        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('users', ['id' => $targetUser->id]);
    }

    public function test_unauthenticated_user_cannot_access(): void
    {
        $response = $this->get(route('admin.user.index'));
        $response->assertRedirect(route('login'));
    }
}

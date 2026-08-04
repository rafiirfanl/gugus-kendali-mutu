<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'view:role', 'guard_name' => 'web']);
        Permission::create(['name' => 'create:role', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit:role', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete:role', 'guard_name' => 'web']);

        $role = Role::create(['name' => 'gkmf', 'guard_name' => 'web']);
        $role->givePermissionTo(['view:role', 'create:role', 'edit:role', 'delete:role']);

        $this->user = User::factory()->create();
        $this->user->assignRole('gkmf');
    }

    public function test_index_returns_200(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.role.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.role.index');
    }

    public function test_index_displays_roles(): void
    {
        Role::create(['name' => 'dosen', 'guard_name' => 'web']);

        $response = $this->actingAs($this->user)->get(route('admin.role.index'));
        $response->assertSeeText('Dosen');
    }

    public function test_destroy_removes_role(): void
    {
        $role = Role::create(['name' => 'to-delete', 'guard_name' => 'web']);

        $response = $this->actingAs($this->user)->delete(route('admin.role.destroy', $role));
        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('roles', ['id' => $role->id]);
    }

    public function test_unauthenticated_user_cannot_access(): void
    {
        $response = $this->get(route('admin.role.index'));
        $response->assertRedirect(route('login'));
    }
}

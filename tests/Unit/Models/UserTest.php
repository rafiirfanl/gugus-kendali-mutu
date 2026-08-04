<?php

namespace Tests\Unit\Models;

use App\Models\Prodi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_user_successfully(): void
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }

    public function test_table_name_is_correct(): void
    {
        $user = new User;

        $this->assertEquals('users', $user->getTable());
    }

    public function test_fillable_attributes_are_mass_assignable(): void
    {
        $fillable = [
            'name',
            'email',
            'nip',
            'ttd',
            'password',
            'prodi_id',
            'email_verified_at',
        ];

        $user = new User;

        $this->assertEquals($fillable, $user->getFillable());
    }

    public function test_user_belongs_to_prodi(): void
    {
        $prodi = Prodi::factory()->create(['kode_prodi' => 'TIK']);
        $user = User::factory()->create(['prodi_id' => $prodi->id]);

        $this->assertInstanceOf(Prodi::class, $user->prodi);
        $this->assertEquals($prodi->id, $user->prodi->id);
    }

    public function test_user_prodi_relationship_returns_belongs_to(): void
    {
        $user = new User;

        $relation = $user->prodi();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function test_hidden_attributes_exclude_sensitive_data(): void
    {
        $user = new User;

        $this->assertContains('password', $user->getHidden());
        $this->assertContains('remember_token', $user->getHidden());
    }

    public function test_password_is_hashed_on_creation(): void
    {
        $user = User::factory()->create(['password' => 'plaintext-password']);

        $this->assertNotEquals('plaintext-password', $user->password);
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('plaintext-password', $user->password));
    }

    public function test_email_verified_at_is_cast_to_datetime(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);

        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $user->email_verified_at);
    }

    public function test_user_can_be_created_with_prodi(): void
    {
        $prodi = Prodi::factory()->create(['kode_prodi' => 'TIK']);
        $user = User::factory()->create(['prodi_id' => $prodi->id]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'prodi_id' => $prodi->id,
        ]);
    }

    public function test_user_can_be_created_without_prodi(): void
    {
        $user = User::factory()->create(['prodi_id' => null]);

        $this->assertNull($user->prodi_id);
        $this->assertNull($user->prodi);
    }

    public function test_user_has_roles_trait(): void
    {
        $user = User::factory()->create();

        $this->assertTrue(method_exists($user, 'hasRole'));
        $this->assertTrue(method_exists($user, 'assignRole'));
        $this->assertTrue(method_exists($user, 'roles'));
    }
}

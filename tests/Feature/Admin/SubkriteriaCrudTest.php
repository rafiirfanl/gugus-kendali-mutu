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

class SubkriteriaCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Kriteria $kriteria;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'view:temuan', 'guard_name' => 'web']);
        Permission::create(['name' => 'create:temuan', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit:temuan', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete:temuan', 'guard_name' => 'web']);

        $role = Role::create(['name' => 'gkmf', 'guard_name' => 'web']);
        $role->givePermissionTo(['view:temuan', 'create:temuan', 'edit:temuan', 'delete:temuan']);

        $this->kriteria = Kriteria::create(['nama' => 'Test Kriteria']);
        $this->user = User::factory()->create();
        $this->user->assignRole('gkmf');
    }

    public function test_create_returns_view(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.temuan.sub.create', $this->kriteria));
        $response->assertStatus(200);
        $response->assertViewIs('admin.data-temuan.subkriteria.create');
    }

    public function test_store_creates_subkriteria_with_hasil_temuan(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.temuan.sub.store', $this->kriteria), [
            'kode' => 'SUB-001',
            'hasil_temuan' => ['Temuan 1', 'Temuan 2'],
        ]);

        $response->assertRedirect(route('admin.temuan.show', $this->kriteria));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('subkriterias', ['kode' => 'SUB-001', 'kriteria_id' => $this->kriteria->id]);
        $this->assertDatabaseHas('hasil_temuans', ['hasil_temuan' => 'Temuan 1']);
        $this->assertDatabaseHas('hasil_temuans', ['hasil_temuan' => 'Temuan 2']);
    }

    public function test_store_validates_required_fields(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.temuan.sub.store', $this->kriteria), []);
        $response->assertSessionHasErrors(['kode', 'hasil_temuan']);
    }

    public function test_edit_returns_view(): void
    {
        $sub = Subkriteria::create(['kode' => 'SUB-EDIT', 'kriteria_id' => $this->kriteria->id]);

        $response = $this->actingAs($this->user)->get(route('admin.temuan.sub.edit', [$this->kriteria, $sub]));
        $response->assertStatus(200);
        $response->assertViewIs('admin.data-temuan.subkriteria.edit');
    }

    public function test_update_modifies_subkriteria(): void
    {
        $sub = Subkriteria::create(['kode' => 'OLD-SUB', 'kriteria_id' => $this->kriteria->id]);

        $response = $this->actingAs($this->user)->put(route('admin.temuan.sub.update', [$this->kriteria, $sub]), [
            'kode' => 'NEW-SUB',
            'hasil_temuan_existing' => ['Updated Temuan 1', 'Updated Temuan 2'],
            'id_hasil_temuan' => ['new', 'new'],
            'ids' => json_encode(['new', 'new']),
            'values' => json_encode(['Updated Temuan 1', 'Updated Temuan 2']),
            'deleted_ids' => json_encode([]),
        ]);

        $response->assertRedirect(route('admin.temuan.show', $this->kriteria));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('subkriterias', ['kode' => 'NEW-SUB']);
    }

    public function test_destroy_removes_subkriteria(): void
    {
        $sub = Subkriteria::create(['kode' => 'TO-DELETE', 'kriteria_id' => $this->kriteria->id]);

        $response = $this->actingAs($this->user)->delete(route('admin.temuan.sub.destroy', [$this->kriteria, $sub]));
        $response->assertRedirect(route('admin.temuan.show', $this->kriteria));
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('subkriterias', ['id' => $sub->id]);
    }

    public function test_unauthenticated_user_cannot_access(): void
    {
        $sub = Subkriteria::create(['kode' => 'SUB', 'kriteria_id' => $this->kriteria->id]);
        $response = $this->get(route('admin.temuan.sub.edit', [$this->kriteria, $sub]));
        $response->assertRedirect(route('login'));
    }
}

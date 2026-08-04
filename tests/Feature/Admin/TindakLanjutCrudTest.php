<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\HasilTemuan;
use App\Models\TindakLanjut;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TindakLanjutCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Prodi $prodi;
    protected HasilTemuan $hasilTemuan;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'progres:tindak-lanjut', 'guard_name' => 'web']);
        Permission::create(['name' => 'update:tindak-lanjut', 'guard_name' => 'web']);

        $role = Role::create(['name' => 'gkmp', 'guard_name' => 'web']);
        $role->givePermissionTo(['progres:tindak-lanjut', 'update:tindak-lanjut']);

        $this->prodi = Prodi::create(['nama_prodi' => 'TI', 'kode_prodi' => 'TI']);
        $kriteria = Kriteria::create(['nama' => 'Kriteria Test']);
        $sub = Subkriteria::create(['kode' => 'SUB-001', 'kriteria_id' => $kriteria->id]);
        $this->hasilTemuan = HasilTemuan::create([
            'subkriteria_id' => $sub->id,
            'hasil_temuan' => 'Temuan Test',
        ]);

        $this->user = User::factory()->create(['prodi_id' => $this->prodi->id]);
        $this->user->assignRole('gkmp');
    }

    public function test_index_returns_200(): void
    {
        $response = $this->actingAs($this->user)->get(route('gkmp.tindak-lanjut.index'));
        $response->assertStatus(200);
        $response->assertViewIs('gkmp.progres-tindak-lanjut.index');
    }

    public function test_index_displays_tindak_lanjut(): void
    {
        TindakLanjut::create([
            'prodi_id' => $this->prodi->id,
            'hasil_temuan_id' => $this->hasilTemuan->id,
            'masukan' => 'Test masukan',
            'tindak_lanjut' => 'Test tindak lanjut',
            'kendala' => 'Test kendala',
        ]);

        $response = $this->actingAs($this->user)->get(route('gkmp.tindak-lanjut.index'));
        $response->assertSee('Test masukan');
    }

    public function test_update_modifies_tindak_lanjut(): void
    {
        $tl = TindakLanjut::create([
            'prodi_id' => $this->prodi->id,
            'hasil_temuan_id' => $this->hasilTemuan->id,
            'masukan' => 'Old masukan',
            'tindak_lanjut' => 'Old tindak lanjut',
            'kendala' => 'Old kendala',
        ]);

        $response = $this->actingAs($this->user)->put(route('gkmp.tindak-lanjut.update', $tl->id), [
            'masukan' => 'Updated masukan',
            'tindak_lanjut' => 'Updated tindak lanjut',
            'kendala' => 'Updated kendala',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('tindak_lanjuts', [
            'id' => $tl->id,
            'masukan' => 'Updated masukan',
            'tindak_lanjut' => 'Updated tindak lanjut',
            'kendala' => 'Updated kendala',
        ]);
    }

    public function test_update_validates_required_fields(): void
    {
        $tl = TindakLanjut::create([
            'prodi_id' => $this->prodi->id,
            'hasil_temuan_id' => $this->hasilTemuan->id,
        ]);

        $response = $this->actingAs($this->user)->put(route('gkmp.tindak-lanjut.update', $tl->id), []);
        $response->assertSessionHasErrors(['masukan', 'tindak_lanjut', 'kendala']);
    }

    public function test_index_shows_empty_when_no_tindak_lanjut(): void
    {
        $response = $this->actingAs($this->user)->get(route('gkmp.tindak-lanjut.index'));
        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_cannot_access(): void
    {
        $response = $this->get(route('gkmp.tindak-lanjut.index'));
        $response->assertRedirect(route('login'));
    }
}

<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Matkul;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\DokumenPerkuliahan;
use App\Models\DokumenKelas;
use App\Models\MatkulDibuka;
use App\Models\TindakLanjut;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'view:dashboard', 'guard_name' => 'web']);
    }

    public function test_gkmf_dashboard_returns_200(): void
    {
        $role = Role::create(['name' => 'gkmf', 'guard_name' => 'web']);
        $role->givePermissionTo('view:dashboard');

        $user = User::factory()->create();
        $user->assignRole('gkmf');

        $response = $this->actingAs($user)->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    public function test_gkmf_dashboard_displays_stats(): void
    {
        $role = Role::create(['name' => 'gkmf', 'guard_name' => 'web']);
        $role->givePermissionTo('view:dashboard');

        $user = User::factory()->create();
        $user->assignRole('gkmf');

        Prodi::create(['nama_prodi' => 'TI', 'kode_prodi' => 'TI']);
        Matkul::create([
            'nama_matkul' => 'Pemrograman',
            'kode_matkul' => 'PW001',
            'bobot_sks' => 3,
            'praktikum' => false,
            'prodi_id' => 1,
        ]);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));
        $response->assertStatus(200);
    }

    public function test_gkmp_dashboard_returns_200(): void
    {
        $role = Role::create(['name' => 'gkmp', 'guard_name' => 'web']);
        $role->givePermissionTo('view:dashboard');

        $prodi = Prodi::create(['nama_prodi' => 'TI', 'kode_prodi' => 'TI']);
        $user = User::factory()->create(['prodi_id' => $prodi->id]);
        $user->assignRole('gkmp');

        $response = $this->actingAs($user)->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    public function test_kaprodi_dashboard_returns_200(): void
    {
        $role = Role::create(['name' => 'kaprodi', 'guard_name' => 'web']);
        $role->givePermissionTo('view:dashboard');

        $prodi = Prodi::create(['nama_prodi' => 'TI', 'kode_prodi' => 'TI']);
        $user = User::factory()->create(['prodi_id' => $prodi->id]);
        $user->assignRole('kaprodi');

        $response = $this->actingAs($user)->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    public function test_dosen_dashboard_returns_200(): void
    {
        $role = Role::create(['name' => 'dosen', 'guard_name' => 'web']);
        $role->givePermissionTo('view:dashboard');

        $prodi = Prodi::create(['nama_prodi' => 'TI', 'kode_prodi' => 'TI']);
        $user = User::factory()->create(['prodi_id' => $prodi->id]);
        $user->assignRole('dosen');

        $response = $this->actingAs($user)->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    public function test_dashboard_with_active_ta(): void
    {
        $role = Role::create(['name' => 'gkmf', 'guard_name' => 'web']);
        $role->givePermissionTo('view:dashboard');

        $user = User::factory()->create();
        $user->assignRole('gkmf');

        TahunAjaran::create([
            'tahun_ajaran' => '2025/2026',
            'jenis' => 'Ganjil',
            'tanggal_mulai_kuliah' => '2025-09-01',
            'is_aktif' => true,
        ]);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));
        $response->assertStatus(200);
    }

    public function test_dashboard_without_active_ta(): void
    {
        $role = Role::create(['name' => 'gkmf', 'guard_name' => 'web']);
        $role->givePermissionTo('view:dashboard');

        $user = User::factory()->create();
        $user->assignRole('gkmf');

        $response = $this->actingAs($user)->get(route('admin.dashboard'));
        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_cannot_access(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_dashboard_with_prodi_stats(): void
    {
        $role = Role::create(['name' => 'gkmf', 'guard_name' => 'web']);
        $role->givePermissionTo('view:dashboard');

        $user = User::factory()->create();
        $user->assignRole('gkmf');

        $prodi = Prodi::create(['nama_prodi' => 'TI', 'kode_prodi' => 'TI']);
        $ta = TahunAjaran::create([
            'tahun_ajaran' => '2025/2026',
            'jenis' => 'Ganjil',
            'tanggal_mulai_kuliah' => '2025-09-01',
            'is_aktif' => true,
        ]);

        $matkul = Matkul::create([
            'nama_matkul' => 'Pemrograman',
            'kode_matkul' => 'PW001',
            'bobot_sks' => 3,
            'praktikum' => false,
            'prodi_id' => $prodi->id,
        ]);

        $matkulDibuka = MatkulDibuka::create([
            'matkul_id' => $matkul->id,
            'tahun_ajaran_id' => $ta->id,
            'jumlah_kelas' => 1,
        ]);

        $dosen = User::factory()->create(['prodi_id' => $prodi->id]);
        $kelas = Kelas::create([
            'nama_kelas' => 'TI-A',
            'dosen_id' => $dosen->id,
            'matkul_dibuka_id' => $matkulDibuka->id,
            'tahun_ajaran_id' => $ta->id,
        ]);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));
        $response->assertStatus(200);
    }
}

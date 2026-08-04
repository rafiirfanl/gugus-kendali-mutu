<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Matkul;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\MatkulDibuka;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignmentDosenTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Prodi $prodi;
    protected TahunAjaran $tahunAjaran;
    protected Matkul $matkul;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'view:assignment-dosen', 'guard_name' => 'web']);
        Permission::create(['name' => 'create:assignment-dosen', 'guard_name' => 'web']);

        $role = Role::create(['name' => 'gkmp', 'guard_name' => 'web']);
        $role->givePermissionTo(['view:assignment-dosen', 'create:assignment-dosen']);

        Role::create(['name' => 'dosen', 'guard_name' => 'web']);

        $this->prodi = Prodi::create(['nama_prodi' => 'TI', 'kode_prodi' => 'TI']);
        $this->tahunAjaran = TahunAjaran::create([
            'tahun_ajaran' => '2025/2026',
            'jenis' => 'Ganjil',
            'tanggal_mulai_kuliah' => '2025-09-01',
            'is_aktif' => true,
        ]);

        $this->matkul = Matkul::create([
            'nama_matkul' => 'Pemrograman',
            'kode_matkul' => 'PW001',
            'bobot_sks' => 3,
            'praktikum' => false,
            'prodi_id' => $this->prodi->id,
        ]);

        $this->user = User::factory()->create(['prodi_id' => $this->prodi->id]);
        $this->user->assignRole('gkmp');
    }

    public function test_step_one_returns_200(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.assignmentDosen.stepOne'));
        $response->assertStatus(200);
        $response->assertViewIs('gkmp.assignment-dosen.step-one');
    }

    public function test_step_one_displays_matkuls(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.assignmentDosen.stepOne'));
        $response->assertSee('Pemrograman');
    }

    public function test_step_two_returns_200(): void
    {
        $response = $this->actingAs($this->user)->get(
            route('admin.assignmentDosen.stepTwo', [
                'matkul_id' => [$this->matkul->id],
                'jumlah_kelas' => [2],
            ])
        );

        $response->assertStatus(200);
        $response->assertViewIs('gkmp.assignment-dosen.step-two');
    }

    public function test_step_two_redirects_when_no_matkul_selected(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.assignmentDosen.stepTwo'));
        $response->assertRedirect(route('admin.assignmentDosen.stepOne'));
    }

    public function test_submit_creates_kelas(): void
    {
        $dosen = User::factory()->create(['prodi_id' => $this->prodi->id]);
        $dosen->assignRole('dosen');

        $this->actingAs($this->user)->withSession([
            'matkul_id' => [$this->matkul->id],
            'jumlah_kelas' => [1],
        ])->post(route('admin.assignmentDosen.submitStepOneAndTwo'), [
            'kelas' => [
                $this->matkul->id => [
                    ['nama_kelas' => 'TI-A', 'dosen_id' => $dosen->id],
                ],
            ],
        ]);

        $this->assertDatabaseHas('kelas', ['nama_kelas' => 'TI-A']);
        $this->assertDatabaseHas('matkul_dibukas', ['matkul_id' => $this->matkul->id]);
    }

    public function test_unauthenticated_user_cannot_access(): void
    {
        $response = $this->get(route('admin.assignmentDosen.stepOne'));
        $response->assertRedirect(route('login'));
    }
}

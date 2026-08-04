<?php

namespace Tests\Unit\Models;

use App\Models\DokumenKelas;
use App\Models\DokumenPerkuliahan;
use App\Models\Kelas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DokumenKelasTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_dokumen_kelas_successfully(): void
    {
        $dokumenKelas = DokumenKelas::factory()->create();

        $this->assertDatabaseHas('dokumen_kelas', [
            'id' => $dokumenKelas->id,
        ]);
    }

    public function test_table_name_is_correct(): void
    {
        $dokumenKelas = new DokumenKelas;

        $this->assertEquals('dokumen_kelas', $dokumenKelas->getTable());
    }

    public function test_fillable_attributes_are_mass_assignable(): void
    {
        $fillable = [
            'kelas_id',
            'dokumen_perkuliahan_id',
            'file_dokumen',
            'waktu_pengumpulan',
            'status',
            'catatan',
        ];

        $dokumenKelas = new DokumenKelas;

        $this->assertEquals($fillable, $dokumenKelas->getFillable());
    }

    public function test_dokumen_kelas_belongs_to_kelas(): void
    {
        $kelas = Kelas::factory()->create();
        $dokumenKelas = DokumenKelas::factory()->create(['kelas_id' => $kelas->id]);

        $this->assertInstanceOf(Kelas::class, $dokumenKelas->kelas);
        $this->assertEquals($kelas->id, $dokumenKelas->kelas->id);
    }

    public function test_dokumen_kelas_kelas_relationship_returns_belongs_to(): void
    {
        $dokumenKelas = new DokumenKelas;

        $relation = $dokumenKelas->kelas();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function test_dokumen_kelas_belongs_to_dokumen_perkuliahan(): void
    {
        $dokumenPerkuliahan = DokumenPerkuliahan::factory()->create();
        $dokumenKelas = DokumenKelas::factory()->create([
            'dokumen_perkuliahan_id' => $dokumenPerkuliahan->id,
        ]);

        $this->assertInstanceOf(DokumenPerkuliahan::class, $dokumenKelas->dokumenPerkuliahan);
        $this->assertEquals($dokumenPerkuliahan->id, $dokumenKelas->dokumenPerkuliahan->id);
    }

    public function test_dokumen_kelas_dokumen_perkuliahan_relationship_returns_belongs_to(): void
    {
        $dokumenKelas = new DokumenKelas;

        $relation = $dokumenKelas->dokumenPerkuliahan();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function test_dikumpulkan_factory_state_sets_correct_values(): void
    {
        $dokumenKelas = DokumenKelas::factory()->dikumpulkan()->create();

        $this->assertEquals('dikumpulkan', $dokumenKelas->status);
        $this->assertNotNull($dokumenKelas->waktu_pengumpulan);
        $this->assertNotNull($dokumenKelas->file_dokumen);
    }

    public function test_ditolak_factory_state_sets_correct_values(): void
    {
        $dokumenKelas = DokumenKelas::factory()->ditolak()->create();

        $this->assertEquals('ditolak', $dokumenKelas->status);
        $this->assertNotNull($dokumenKelas->catatan);
    }

    public function test_dokumen_kelas_file_dokumen_is_nullable(): void
    {
        $dokumenKelas = DokumenKelas::factory()->create(['file_dokumen' => null]);

        $this->assertNull($dokumenKelas->file_dokumen);
    }

    public function test_dokumen_kelas_waktu_pengumpulan_is_nullable(): void
    {
        $dokumenKelas = DokumenKelas::factory()->create(['waktu_pengumpulan' => null]);

        $this->assertNull($dokumenKelas->waktu_pengumpulan);
    }

    public function test_dokumen_kelas_can_be_created_with_all_relations(): void
    {
        $kelas = Kelas::factory()->create();
        $dokumenPerkuliahan = DokumenPerkuliahan::factory()->create();

        $dokumenKelas = DokumenKelas::factory()->create([
            'kelas_id' => $kelas->id,
            'dokumen_perkuliahan_id' => $dokumenPerkuliahan->id,
        ]);

        $this->assertDatabaseHas('dokumen_kelas', [
            'id' => $dokumenKelas->id,
            'kelas_id' => $kelas->id,
            'dokumen_perkuliahan_id' => $dokumenPerkuliahan->id,
        ]);
    }
}

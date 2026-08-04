<?php

namespace Tests\Unit\Models;

use App\Models\DokumenKelas;
use App\Models\DokumenPerkuliahan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DokumenPerkuliahanTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_dokumen_perkuliahan_successfully(): void
    {
        $dokumenPerkuliahan = DokumenPerkuliahan::factory()->create();

        $this->assertDatabaseHas('dokumen_perkuliahans', [
            'nama_dokumen' => $dokumenPerkuliahan->nama_dokumen,
        ]);
    }

    public function test_table_name_is_correct(): void
    {
        $dokumenPerkuliahan = new DokumenPerkuliahan;

        $this->assertEquals('dokumen_perkuliahans', $dokumenPerkuliahan->getTable());
    }

    public function test_fillable_attributes_are_mass_assignable(): void
    {
        $fillable = [
            'nama_dokumen',
            'sesi',
            'tenggat_waktu_default',
            'template',
        ];

        $dokumenPerkuliahan = new DokumenPerkuliahan;

        $this->assertEquals($fillable, $dokumenPerkuliahan->getFillable());
    }

    public function test_dokumen_perkuliahan_has_many_dokumen_kelas(): void
    {
        $dokumenPerkuliahan = DokumenPerkuliahan::factory()->create();
        DokumenKelas::factory()->count(3)->create([
            'dokumen_perkuliahan_id' => $dokumenPerkuliahan->id,
        ]);

        $this->assertCount(3, $dokumenPerkuliahan->dokumenKelas);
        $this->assertInstanceOf(DokumenKelas::class, $dokumenPerkuliahan->dokumenKelas->first());
    }

    public function test_dokumen_perkuliahan_dokumen_kelas_relationship_returns_has_many(): void
    {
        $dokumenPerkuliahan = new DokumenPerkuliahan;

        $relation = $dokumenPerkuliahan->dokumenKelas();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }

    public function test_dokumen_perkuliahan_sesi_is_mass_assignable(): void
    {
        $dokumenPerkuliahan = DokumenPerkuliahan::factory()->create(['sesi' => 4]);

        $this->assertEquals(4, $dokumenPerkuliahan->sesi);
    }

    public function test_dokumen_perkuliahan_tenggat_waktu_default_is_mass_assignable(): void
    {
        $dokumenPerkuliahan = DokumenPerkuliahan::factory()->create(['tenggat_waktu_default' => 14]);

        $this->assertEquals(14, $dokumenPerkuliahan->tenggat_waktu_default);
    }

    public function test_dokumen_perkuliahan_template_is_nullable(): void
    {
        $dokumenPerkuliahan = DokumenPerkuliahan::factory()->create(['template' => null]);

        $this->assertNull($dokumenPerkuliahan->template);
    }

    public function test_dokumen_perkuliahan_returns_empty_collection_when_no_dokumen_kelas(): void
    {
        $dokumenPerkuliahan = DokumenPerkuliahan::factory()->create();

        $this->assertCount(0, $dokumenPerkuliahan->dokumenKelas);
    }
}

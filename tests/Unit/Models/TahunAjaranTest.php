<?php

namespace Tests\Unit\Models;

use App\Models\Kelas;
use App\Models\MatkulDibuka;
use App\Models\TahunAjaran;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TahunAjaranTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_tahun_ajaran_successfully(): void
    {
        $tahunAjaran = TahunAjaran::factory()->create();

        $this->assertDatabaseHas('tahun_ajarans', [
            'tahun_ajaran' => $tahunAjaran->tahun_ajaran,
        ]);
    }

    public function test_table_name_is_correct(): void
    {
        $tahunAjaran = new TahunAjaran;

        $this->assertEquals('tahun_ajarans', $tahunAjaran->getTable());
    }

    public function test_fillable_attributes_are_mass_assignable(): void
    {
        $fillable = [
            'tahun_ajaran',
            'jenis',
            'tanggal_mulai_kuliah',
            'is_aktif',
        ];

        $tahunAjaran = new TahunAjaran;

        $this->assertEquals($fillable, $tahunAjaran->getFillable());
    }

    public function test_tahun_ajaran_has_many_kelas(): void
    {
        $tahunAjaran = TahunAjaran::factory()->create();
        Kelas::factory()->count(3)->create(['tahun_ajaran_id' => $tahunAjaran->id]);

        $this->assertCount(3, $tahunAjaran->kelas);
        $this->assertInstanceOf(Kelas::class, $tahunAjaran->kelas->first());
    }

    public function test_tahun_ajaran_kelas_relationship_returns_has_many(): void
    {
        $tahunAjaran = new TahunAjaran;

        $relation = $tahunAjaran->kelas();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }

    public function test_tahun_ajaran_has_many_matkul_dibuka(): void
    {
        $tahunAjaran = TahunAjaran::factory()->create();
        MatkulDibuka::factory()->count(2)->create(['tahun_ajaran_id' => $tahunAjaran->id]);

        $this->assertCount(2, $tahunAjaran->matkulDibuka);
        $this->assertInstanceOf(MatkulDibuka::class, $tahunAjaran->matkulDibuka->first());
    }

    public function test_tahun_ajaran_matkul_dibuka_relationship_returns_has_many(): void
    {
        $tahunAjaran = new TahunAjaran;

        $relation = $tahunAjaran->matkulDibuka();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }

    public function test_tahun_ajaran_is_aktif_default_is_false(): void
    {
        $tahunAjaran = TahunAjaran::factory()->create();

        $this->assertFalse((bool) $tahunAjaran->is_aktif);
    }

    public function test_tahun_ajaran_aktif_factory_state(): void
    {
        $tahunAjaran = TahunAjaran::factory()->aktif()->create();

        $this->assertTrue((bool) $tahunAjaran->is_aktif);
    }

    public function test_tahun_ajaran_is_aktif_is_mass_assignable(): void
    {
        $tahunAjaran = TahunAjaran::factory()->create(['is_aktif' => true]);

        $this->assertTrue((bool) $tahunAjaran->is_aktif);
    }

    public function test_tahun_ajaran_returns_empty_collections_when_no_related_models(): void
    {
        $tahunAjaran = TahunAjaran::factory()->create();

        $this->assertCount(0, $tahunAjaran->kelas);
        $this->assertCount(0, $tahunAjaran->matkulDibuka);
    }
}

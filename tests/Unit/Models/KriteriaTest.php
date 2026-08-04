<?php

namespace Tests\Unit\Models;

use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KriteriaTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_kriteria_successfully(): void
    {
        $kriteria = Kriteria::factory()->create();

        $this->assertDatabaseHas('kriterias', [
            'nama' => $kriteria->nama,
        ]);
    }

    public function test_table_name_is_correct(): void
    {
        $kriteria = new Kriteria;

        $this->assertEquals('kriterias', $kriteria->getTable());
    }

    public function test_fillable_attributes_are_mass_assignable(): void
    {
        $fillable = ['nama'];

        $kriteria = new Kriteria;

        $this->assertEquals($fillable, $kriteria->getFillable());
    }

    public function test_kriteria_has_many_subkriterias(): void
    {
        $kriteria = Kriteria::factory()->create();
        Subkriteria::factory()->count(3)->create(['kriteria_id' => $kriteria->id]);

        $this->assertCount(3, $kriteria->subkriterias);
        $this->assertInstanceOf(Subkriteria::class, $kriteria->subkriterias->first());
    }

    public function test_kriteria_subkriterias_relationship_returns_has_many(): void
    {
        $kriteria = new Kriteria;

        $relation = $kriteria->subkriterias();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }

    public function test_kriteria_returns_empty_collection_when_no_subkriterias(): void
    {
        $kriteria = Kriteria::factory()->create();

        $this->assertCount(0, $kriteria->subkriterias);
    }

    public function test_kriteria_cascade_delete_removes_subkriterias(): void
    {
        $kriteria = Kriteria::factory()->create();
        Subkriteria::factory()->count(3)->create(['kriteria_id' => $kriteria->id]);

        $this->assertDatabaseCount('subkriterias', 3);

        $kriteria->delete();

        $this->assertDatabaseCount('subkriterias', 0);
    }

    public function test_kriteria_nama_is_mass_assignable(): void
    {
        $kriteria = Kriteria::factory()->create(['nama' => 'Kriteria Penilaian']);

        $this->assertEquals('Kriteria Penilaian', $kriteria->nama);
    }
}

<?php

namespace Tests\Unit\Models;

use App\Models\HasilTemuan;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubkriteriaTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_subkriteria_successfully(): void
    {
        $subkriteria = Subkriteria::factory()->create(['kode' => 'A1']);

        $this->assertDatabaseHas('subkriterias', [
            'kode' => $subkriteria->kode,
        ]);
    }

    public function test_table_name_is_correct(): void
    {
        $subkriteria = new Subkriteria;

        $this->assertEquals('subkriterias', $subkriteria->getTable());
    }

    public function test_fillable_attributes_are_mass_assignable(): void
    {
        $fillable = ['kriteria_id', 'kode'];

        $subkriteria = new Subkriteria;

        $this->assertEquals($fillable, $subkriteria->getFillable());
    }

    public function test_subkriteria_belongs_to_kriteria(): void
    {
        $kriteria = Kriteria::factory()->create();
        $subkriteria = Subkriteria::factory()->create(['kriteria_id' => $kriteria->id, 'kode' => 'A1']);

        $this->assertInstanceOf(Kriteria::class, $subkriteria->kriteria);
        $this->assertEquals($kriteria->id, $subkriteria->kriteria->id);
    }

    public function test_subkriteria_kriteria_relationship_returns_belongs_to(): void
    {
        $subkriteria = new Subkriteria;

        $relation = $subkriteria->kriteria();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function test_subkriteria_has_many_hasil_temuans(): void
    {
        $subkriteria = Subkriteria::factory()->create(['kode' => 'A2']);
        HasilTemuan::factory()->count(3)->create(['subkriteria_id' => $subkriteria->id]);

        $this->assertCount(3, $subkriteria->hasilTemuans);
        $this->assertInstanceOf(HasilTemuan::class, $subkriteria->hasilTemuans->first());
    }

    public function test_subkriteria_hasil_temuans_relationship_returns_has_many(): void
    {
        $subkriteria = new Subkriteria;

        $relation = $subkriteria->hasilTemuans();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }

    public function test_subkriteria_cascade_delete_removes_hasil_temuans(): void
    {
        $subkriteria = Subkriteria::factory()->create(['kode' => 'A3']);
        HasilTemuan::factory()->count(3)->create(['subkriteria_id' => $subkriteria->id]);

        $this->assertDatabaseCount('hasil_temuans', 3);

        $subkriteria->delete();

        $this->assertDatabaseCount('hasil_temuans', 0);
    }

    public function test_subkriteria_kode_is_mass_assignable(): void
    {
        $subkriteria = Subkriteria::factory()->create(['kode' => 'B1']);

        $this->assertEquals('B1', $subkriteria->kode);
    }

    public function test_subkriteria_returns_empty_collection_when_no_hasil_temuans(): void
    {
        $subkriteria = Subkriteria::factory()->create(['kode' => 'C1']);

        $this->assertCount(0, $subkriteria->hasilTemuans);
    }

    public function test_subkriteria_creates_with_valid_kriteria(): void
    {
        $kriteria = Kriteria::factory()->create();
        $subkriteria = Subkriteria::factory()->create(['kriteria_id' => $kriteria->id, 'kode' => 'D1']);

        $this->assertDatabaseHas('subkriterias', [
            'id' => $subkriteria->id,
            'kriteria_id' => $kriteria->id,
        ]);
    }
}

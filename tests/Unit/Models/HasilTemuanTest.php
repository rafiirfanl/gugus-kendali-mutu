<?php

namespace Tests\Unit\Models;

use App\Models\HasilTemuan;
use App\Models\Subkriteria;
use App\Models\TindakLanjut;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HasilTemuanTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_hasil_temuan_successfully(): void
    {
        $subkriteria = Subkriteria::factory()->create(['kode' => 'A1']);
        $hasilTemuan = HasilTemuan::factory()->create(['subkriteria_id' => $subkriteria->id]);

        $this->assertDatabaseHas('hasil_temuans', [
            'hasil_temuan' => $hasilTemuan->hasil_temuan,
        ]);
    }

    public function test_table_name_is_correct(): void
    {
        $hasilTemuan = new HasilTemuan;

        $this->assertEquals('hasil_temuans', $hasilTemuan->getTable());
    }

    public function test_fillable_attributes_are_mass_assignable(): void
    {
        $fillable = [
            'subkriteria_id',
            'prodi_id',
            'hasil_temuan',
        ];

        $hasilTemuan = new HasilTemuan;

        $this->assertEquals($fillable, $hasilTemuan->getFillable());
    }

    public function test_hasil_temuan_belongs_to_subkriteria(): void
    {
        $subkriteria = Subkriteria::factory()->create(['kode' => 'A1']);
        $hasilTemuan = HasilTemuan::factory()->create(['subkriteria_id' => $subkriteria->id]);

        $this->assertInstanceOf(Subkriteria::class, $hasilTemuan->subkriteria);
        $this->assertEquals($subkriteria->id, $hasilTemuan->subkriteria->id);
    }

    public function test_hasil_temuan_subkriteria_relationship_returns_belongs_to(): void
    {
        $hasilTemuan = new HasilTemuan;

        $relation = $hasilTemuan->subkriteria();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function test_hasil_temuan_has_many_tindak_lanjuts(): void
    {
        $subkriteria = Subkriteria::factory()->create(['kode' => 'A1']);
        $hasilTemuan = HasilTemuan::factory()->create(['subkriteria_id' => $subkriteria->id]);
        TindakLanjut::factory()->count(3)->create(['hasil_temuan_id' => $hasilTemuan->id]);

        $this->assertCount(3, $hasilTemuan->tindakLanjuts);
        $this->assertInstanceOf(TindakLanjut::class, $hasilTemuan->tindakLanjuts->first());
    }

    public function test_hasil_temuan_tindak_lanjuts_relationship_returns_has_many(): void
    {
        $hasilTemuan = new HasilTemuan;

        $relation = $hasilTemuan->tindakLanjuts();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }

    public function test_hasil_temuan_hasil_temuan_is_mass_assignable(): void
    {
        $subkriteria = Subkriteria::factory()->create(['kode' => 'A1']);
        $hasilTemuan = HasilTemuan::factory()->create([
            'subkriteria_id' => $subkriteria->id,
            'hasil_temuan' => 'Temuan penting',
        ]);

        $this->assertEquals('Temuan penting', $hasilTemuan->hasil_temuan);
    }

    public function test_hasil_temuan_creates_with_valid_subkriteria(): void
    {
        $subkriteria = Subkriteria::factory()->create(['kode' => 'A1']);
        $hasilTemuan = HasilTemuan::factory()->create(['subkriteria_id' => $subkriteria->id]);

        $this->assertDatabaseHas('hasil_temuans', [
            'id' => $hasilTemuan->id,
            'subkriteria_id' => $subkriteria->id,
        ]);
    }

    public function test_hasil_temuan_returns_empty_collection_when_no_tindak_lanjuts(): void
    {
        $subkriteria = Subkriteria::factory()->create(['kode' => 'A1']);
        $hasilTemuan = HasilTemuan::factory()->create(['subkriteria_id' => $subkriteria->id]);

        $this->assertCount(0, $hasilTemuan->tindakLanjuts);
    }

    public function test_hasil_temuan_has_prodi_id_in_fillable(): void
    {
        $hasilTemuan = new HasilTemuan;

        $this->assertContains('prodi_id', $hasilTemuan->getFillable());
    }
}

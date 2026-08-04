<?php

namespace Tests\Unit\Models;

use App\Models\HasilTemuan;
use App\Models\Prodi;
use App\Models\TindakLanjut;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TindakLanjutTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_tindak_lanjut_successfully(): void
    {
        $prodi = Prodi::factory()->create(['kode_prodi' => 'TIK']);
        $tindakLanjut = TindakLanjut::factory()->create(['prodi_id' => $prodi->id]);

        $this->assertDatabaseHas('tindak_lanjuts', [
            'tindak_lanjut' => $tindakLanjut->tindak_lanjut,
        ]);
    }

    public function test_table_name_is_correct(): void
    {
        $tindakLanjut = new TindakLanjut;

        $this->assertEquals('tindak_lanjuts', $tindakLanjut->getTable());
    }

    public function test_fillable_attributes_are_mass_assignable(): void
    {
        $fillable = [
            'prodi_id',
            'hasil_temuan_id',
            'tindak_lanjut',
            'kendala',
            'masukan',
        ];

        $tindakLanjut = new TindakLanjut;

        $this->assertEquals($fillable, $tindakLanjut->getFillable());
    }

    public function test_tindak_lanjut_belongs_to_prodi(): void
    {
        $prodi = Prodi::factory()->create(['kode_prodi' => 'TIK']);
        $tindakLanjut = TindakLanjut::factory()->create(['prodi_id' => $prodi->id]);

        $this->assertInstanceOf(Prodi::class, $tindakLanjut->prodi);
        $this->assertEquals($prodi->id, $tindakLanjut->prodi->id);
    }

    public function test_tindak_lanjut_prodi_relationship_returns_belongs_to(): void
    {
        $tindakLanjut = new TindakLanjut;

        $relation = $tindakLanjut->prodi();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function test_tindak_lanjut_belongs_to_hasil_temuan(): void
    {
        $subkriteria = \App\Models\Subkriteria::factory()->create(['kode' => 'A1']);
        $hasilTemuan = HasilTemuan::factory()->create(['subkriteria_id' => $subkriteria->id]);
        $tindakLanjut = TindakLanjut::factory()->create(['hasil_temuan_id' => $hasilTemuan->id]);

        $this->assertInstanceOf(HasilTemuan::class, $tindakLanjut->hasilTemuan);
        $this->assertEquals($hasilTemuan->id, $tindakLanjut->hasilTemuan->id);
    }

    public function test_tindak_lanjut_hasil_temuan_relationship_returns_belongs_to(): void
    {
        $tindakLanjut = new TindakLanjut;

        $relation = $tindakLanjut->hasilTemuan();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function test_tindak_lanjut_tindak_lanjut_is_mass_assignable(): void
    {
        $tindakLanjut = TindakLanjut::factory()->create(['tindak_lanjut' => 'Perbaikan diperlukan']);

        $this->assertEquals('Perbaikan diperlukan', $tindakLanjut->tindak_lanjut);
    }

    public function test_tindak_lanjut_kendala_is_nullable(): void
    {
        $tindakLanjut = TindakLanjut::factory()->create(['kendala' => null]);

        $this->assertNull($tindakLanjut->kendala);
    }

    public function test_tindak_lanjut_masukan_is_nullable(): void
    {
        $tindakLanjut = TindakLanjut::factory()->create(['masukan' => null]);

        $this->assertNull($tindakLanjut->masukan);
    }

    public function test_tindak_lanjut_kendala_is_mass_assignable(): void
    {
        $tindakLanjut = TindakLanjut::factory()->create(['kendala' => 'Kurang dana']);

        $this->assertEquals('Kurang dana', $tindakLanjut->kendala);
    }

    public function test_tindak_lanjut_masukan_is_mass_assignable(): void
    {
        $tindakLanjut = TindakLanjut::factory()->create(['masukan' => 'Tingkatkan koordinasi']);

        $this->assertEquals('Tingkatkan koordinasi', $tindakLanjut->masukan);
    }

    public function test_tindak_lanjut_creates_with_valid_prodi_and_hasil_temuan(): void
    {
        $prodi = Prodi::factory()->create(['kode_prodi' => 'TIK']);
        $subkriteria = \App\Models\Subkriteria::factory()->create(['kode' => 'A1']);
        $hasilTemuan = HasilTemuan::factory()->create(['subkriteria_id' => $subkriteria->id]);

        $tindakLanjut = TindakLanjut::factory()->create([
            'prodi_id' => $prodi->id,
            'hasil_temuan_id' => $hasilTemuan->id,
        ]);

        $this->assertDatabaseHas('tindak_lanjuts', [
            'id' => $tindakLanjut->id,
            'prodi_id' => $prodi->id,
            'hasil_temuan_id' => $hasilTemuan->id,
        ]);
    }

    public function test_tindak_lanjut_can_be_created_with_nullable_relations(): void
    {
        $tindakLanjut = TindakLanjut::factory()->create([
            'prodi_id' => null,
            'hasil_temuan_id' => null,
        ]);

        $this->assertNull($tindakLanjut->prodi_id);
        $this->assertNull($tindakLanjut->hasil_temuan_id);
    }
}

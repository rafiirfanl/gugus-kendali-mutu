<?php

namespace Tests\Unit\Models;

use App\Models\Matkul;
use App\Models\Prodi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MatkulTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_matkul_successfully(): void
    {
        $matkul = Matkul::factory()->create(['kode_matkul' => 'MK01']);

        $this->assertDatabaseHas('matkuls', [
            'nama_matkul' => $matkul->nama_matkul,
            'kode_matkul' => $matkul->kode_matkul,
        ]);
    }

    public function test_table_name_is_correct(): void
    {
        $matkul = new Matkul;

        $this->assertEquals('matkuls', $matkul->getTable());
    }

    public function test_fillable_attributes_are_mass_assignable(): void
    {
        $fillable = [
            'nama_matkul',
            'kode_matkul',
            'bobot_sks',
            'praktikum',
            'prodi_id',
        ];

        $matkul = new Matkul;

        $this->assertEquals($fillable, $matkul->getFillable());
    }

    public function test_matkul_belongs_to_prodi(): void
    {
        $prodi = Prodi::factory()->create(['kode_prodi' => 'TIK']);
        $matkul = Matkul::factory()->create(['prodi_id' => $prodi->id, 'kode_matkul' => 'MK01']);

        $this->assertInstanceOf(Prodi::class, $matkul->prodi);
        $this->assertEquals($prodi->id, $matkul->prodi->id);
    }

    public function test_matkul_prodi_relationship_returns_belongs_to(): void
    {
        $matkul = new Matkul;

        $relation = $matkul->prodi();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function test_matkul_can_be_created_with_prodi(): void
    {
        $prodi = Prodi::factory()->create(['kode_prodi' => 'TIK']);
        $matkul = Matkul::factory()->create(['prodi_id' => $prodi->id, 'kode_matkul' => 'MK01']);

        $this->assertDatabaseHas('matkuls', [
            'id' => $matkul->id,
            'prodi_id' => $prodi->id,
        ]);
    }

    public function test_matkul_can_be_created_without_prodi(): void
    {
        $matkul = Matkul::factory()->create(['prodi_id' => null, 'kode_matkul' => 'MK02']);

        $this->assertNull($matkul->prodi_id);
    }

    public function test_matkul_bobot_sks_is_mass_assignable(): void
    {
        $matkul = Matkul::factory()->create(['bobot_sks' => 4, 'kode_matkul' => 'MK03']);

        $this->assertEquals(4, $matkul->bobot_sks);
    }

    public function test_matkul_praktikum_is_mass_assignable(): void
    {
        $matkul = Matkul::factory()->create(['praktikum' => true, 'kode_matkul' => 'MK04']);

        $this->assertTrue($matkul->praktikum);
    }
}

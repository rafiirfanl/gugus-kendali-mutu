<?php

namespace Tests\Unit\Models;

use App\Models\Matkul;
use App\Models\MatkulDibuka;
use App\Models\TahunAjaran;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MatkulDibukaTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_matkul_dibuka_successfully(): void
    {
        $matkul = Matkul::factory()->create(['kode_matkul' => 'MK01']);
        $tahunAjaran = TahunAjaran::factory()->create();
        $matkulDibuka = MatkulDibuka::factory()->create([
            'matkul_id' => $matkul->id,
            'tahun_ajaran_id' => $tahunAjaran->id,
        ]);

        $this->assertDatabaseHas('matkul_dibukas', [
            'matkul_id' => $matkulDibuka->matkul_id,
            'tahun_ajaran_id' => $matkulDibuka->tahun_ajaran_id,
        ]);
    }

    public function test_table_name_is_correct(): void
    {
        $matkulDibuka = new MatkulDibuka;

        $this->assertEquals('matkul_dibukas', $matkulDibuka->getTable());
    }

    public function test_fillable_attributes_are_mass_assignable(): void
    {
        $fillable = [
            'matkul_id',
            'tahun_ajaran_id',
            'jumlah_kelas',
        ];

        $matkulDibuka = new MatkulDibuka;

        $this->assertEquals($fillable, $matkulDibuka->getFillable());
    }

    public function test_matkul_dibuka_belongs_to_matkul(): void
    {
        $matkul = Matkul::factory()->create(['kode_matkul' => 'MK01']);
        $matkulDibuka = MatkulDibuka::factory()->create(['matkul_id' => $matkul->id]);

        $this->assertInstanceOf(Matkul::class, $matkulDibuka->matkul);
        $this->assertEquals($matkul->id, $matkulDibuka->matkul->id);
    }

    public function test_matkul_dibuka_matkul_relationship_returns_belongs_to(): void
    {
        $matkulDibuka = new MatkulDibuka;

        $relation = $matkulDibuka->matkul();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function test_matkul_dibuka_belongs_to_tahun_ajaran(): void
    {
        $tahunAjaran = TahunAjaran::factory()->create();
        $matkulDibuka = MatkulDibuka::factory()->create(['tahun_ajaran_id' => $tahunAjaran->id]);

        $this->assertInstanceOf(TahunAjaran::class, $matkulDibuka->tahunAjaran);
        $this->assertEquals($tahunAjaran->id, $matkulDibuka->tahunAjaran->id);
    }

    public function test_matkul_dibuka_tahun_ajaran_relationship_returns_belongs_to(): void
    {
        $matkulDibuka = new MatkulDibuka;

        $relation = $matkulDibuka->tahunAjaran();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function test_matkul_dibuka_jumlah_kelas_is_mass_assignable(): void
    {
        $matkulDibuka = MatkulDibuka::factory()->create(['jumlah_kelas' => 5]);

        $this->assertEquals(5, $matkulDibuka->jumlah_kelas);
    }

    public function test_matkul_dibuka_creates_with_valid_matkul_and_tahun_ajaran(): void
    {
        $matkul = Matkul::factory()->create(['kode_matkul' => 'MK05']);
        $tahunAjaran = TahunAjaran::factory()->create();
        $matkulDibuka = MatkulDibuka::factory()->create([
            'matkul_id' => $matkul->id,
            'tahun_ajaran_id' => $tahunAjaran->id,
        ]);

        $this->assertDatabaseHas('matkul_dibukas', [
            'id' => $matkulDibuka->id,
            'matkul_id' => $matkul->id,
            'tahun_ajaran_id' => $tahunAjaran->id,
        ]);
    }
}

<?php

namespace Tests\Unit\Models;

use App\Models\DokumenKelas;
use App\Models\Kelas;
use App\Models\MatkulDibuka;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KelasTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_kelas_successfully(): void
    {
        $kelas = Kelas::factory()->create(['nama_kelas' => 'Kelas A']);

        $this->assertDatabaseHas('kelas', [
            'nama_kelas' => $kelas->nama_kelas,
        ]);
    }

    public function test_table_name_is_correct(): void
    {
        $kelas = new Kelas;

        $this->assertEquals('kelas', $kelas->getTable());
    }

    public function test_fillable_attributes_are_mass_assignable(): void
    {
        $fillable = [
            'nama_kelas',
            'dosen_id',
            'matkul_dibuka_id',
            'tahun_ajaran_id',
        ];

        $kelas = new Kelas;

        $this->assertEquals($fillable, $kelas->getFillable());
    }

    public function test_kelas_belongs_to_matkul_dibuka(): void
    {
        $matkulDibuka = MatkulDibuka::factory()->create();
        $kelas = Kelas::factory()->create([
            'matkul_dibuka_id' => $matkulDibuka->id,
            'nama_kelas' => 'Kelas B',
        ]);

        $this->assertInstanceOf(MatkulDibuka::class, $kelas->matkulDibuka);
        $this->assertEquals($matkulDibuka->id, $kelas->matkulDibuka->id);
    }

    public function test_kelas_matkul_dibuka_relationship_returns_belongs_to(): void
    {
        $kelas = new Kelas;

        $relation = $kelas->matkulDibuka();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function test_kelas_belongs_to_tahun_ajaran(): void
    {
        $tahunAjaran = TahunAjaran::factory()->create();
        $kelas = Kelas::factory()->create([
            'tahun_ajaran_id' => $tahunAjaran->id,
            'nama_kelas' => 'Kelas C',
        ]);

        $this->assertInstanceOf(TahunAjaran::class, $kelas->tahunAjaran);
        $this->assertEquals($tahunAjaran->id, $kelas->tahunAjaran->id);
    }

    public function test_kelas_tahun_ajaran_relationship_returns_belongs_to(): void
    {
        $kelas = new Kelas;

        $relation = $kelas->tahunAjaran();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function test_kelas_belongs_to_dosen(): void
    {
        $dosen = User::factory()->create();
        $kelas = Kelas::factory()->create([
            'dosen_id' => $dosen->id,
            'nama_kelas' => 'Kelas D',
        ]);

        $this->assertInstanceOf(User::class, $kelas->dosen);
        $this->assertEquals($dosen->id, $kelas->dosen->id);
    }

    public function test_kelas_dosen_relationship_returns_belongs_to(): void
    {
        $kelas = new Kelas;

        $relation = $kelas->dosen();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function test_kelas_has_many_dokumen_kelas(): void
    {
        $kelas = Kelas::factory()->create(['nama_kelas' => 'Kelas E']);
        DokumenKelas::factory()->count(3)->create(['kelas_id' => $kelas->id]);

        $this->assertCount(3, $kelas->dokumenKelas);
        $this->assertInstanceOf(DokumenKelas::class, $kelas->dokumenKelas->first());
    }

    public function test_kelas_dokumen_kelas_relationship_returns_has_many(): void
    {
        $kelas = new Kelas;

        $relation = $kelas->dokumenKelas();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }

    public function test_kelas_can_be_created_with_all_relations(): void
    {
        $dosen = User::factory()->create();
        $matkulDibuka = MatkulDibuka::factory()->create();
        $tahunAjaran = TahunAjaran::factory()->create();

        $kelas = Kelas::factory()->create([
            'dosen_id' => $dosen->id,
            'matkul_dibuka_id' => $matkulDibuka->id,
            'tahun_ajaran_id' => $tahunAjaran->id,
            'nama_kelas' => 'Kelas F',
        ]);

        $this->assertDatabaseHas('kelas', [
            'id' => $kelas->id,
            'dosen_id' => $dosen->id,
            'matkul_dibuka_id' => $matkulDibuka->id,
            'tahun_ajaran_id' => $tahunAjaran->id,
        ]);
    }

    public function test_kelas_can_be_created_with_nullable_relations(): void
    {
        $kelas = Kelas::factory()->create([
            'dosen_id' => null,
            'matkul_dibuka_id' => null,
            'tahun_ajaran_id' => null,
            'nama_kelas' => 'Kelas G',
        ]);

        $this->assertNull($kelas->dosen_id);
        $this->assertNull($kelas->matkul_dibuka_id);
        $this->assertNull($kelas->tahun_ajaran_id);
    }
}

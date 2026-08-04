<?php

namespace Tests\Unit\Models;

use App\Models\Matkul;
use App\Models\Prodi;
use App\Models\TindakLanjut;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProdiTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_prodi_successfully(): void
    {
        $prodi = Prodi::factory()->create(['kode_prodi' => 'TIK']);

        $this->assertDatabaseHas('prodis', [
            'nama_prodi' => $prodi->nama_prodi,
            'kode_prodi' => $prodi->kode_prodi,
        ]);
    }

    public function test_table_name_is_correct(): void
    {
        $prodi = new Prodi;

        $this->assertEquals('prodis', $prodi->getTable());
    }

    public function test_fillable_attributes_are_mass_assignable(): void
    {
        $fillable = [
            'nama_prodi',
            'kode_prodi',
        ];

        $prodi = new Prodi;

        $this->assertEquals($fillable, $prodi->getFillable());
    }

    public function test_prodi_has_many_users(): void
    {
        $prodi = Prodi::factory()->create(['kode_prodi' => 'TIK']);
        User::factory()->count(3)->create(['prodi_id' => $prodi->id]);

        $this->assertCount(3, $prodi->users);
        $this->assertInstanceOf(User::class, $prodi->users->first());
    }

    public function test_prodi_users_relationship_returns_has_many(): void
    {
        $prodi = new Prodi;

        $relation = $prodi->users();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }

    public function test_prodi_has_many_matkuls(): void
    {
        $prodi = Prodi::factory()->create(['kode_prodi' => 'TIK']);
        Matkul::factory()->count(2)->create(['prodi_id' => $prodi->id]);

        $this->assertCount(2, $prodi->matkuls);
        $this->assertInstanceOf(Matkul::class, $prodi->matkuls->first());
    }

    public function test_prodi_matkuls_relationship_returns_has_many(): void
    {
        $prodi = new Prodi;

        $relation = $prodi->matkuls();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }

    public function test_prodi_has_many_tindak_lanjuts(): void
    {
        $prodi = Prodi::factory()->create(['kode_prodi' => 'TIK']);
        TindakLanjut::factory()->count(2)->create(['prodi_id' => $prodi->id]);

        $this->assertCount(2, $prodi->tindakLanjuts);
        $this->assertInstanceOf(TindakLanjut::class, $prodi->tindakLanjuts->first());
    }

    public function test_prodi_tindak_lanjuts_relationship_returns_has_many(): void
    {
        $prodi = new Prodi;

        $relation = $prodi->tindakLanjuts();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }

    public function test_prodi_returns_empty_collections_when_no_related_models(): void
    {
        $prodi = Prodi::factory()->create(['kode_prodi' => 'TIK']);

        $this->assertCount(0, $prodi->users);
        $this->assertCount(0, $prodi->matkuls);
        $this->assertCount(0, $prodi->tindakLanjuts);
    }
}

<?php

namespace Database\Factories;

use App\Models\MatkulDibuka;
use App\Models\Matkul;
use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatkulDibukaFactory extends Factory
{
    protected $model = MatkulDibuka::class;

    public function definition(): array
    {
        return [
            'matkul_id' => Matkul::factory(),
            'tahun_ajaran_id' => TahunAjaran::factory(),
            'jumlah_kelas' => fake()->numberBetween(1, 5),
        ];
    }
}

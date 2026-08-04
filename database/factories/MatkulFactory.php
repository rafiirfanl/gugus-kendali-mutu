<?php

namespace Database\Factories;

use App\Models\Matkul;
use App\Models\Prodi;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatkulFactory extends Factory
{
    protected $model = Matkul::class;

    public function definition(): array
    {
        return [
            'nama_matkul' => fake()->unique()->words(3, true),
            'kode_matkul' => strtoupper(fake()->unique()->bothify('????')),
            'bobot_sks' => fake()->numberBetween(1, 4),
            'praktikum' => fake()->boolean(),
            'prodi_id' => Prodi::factory(),
        ];
    }
}

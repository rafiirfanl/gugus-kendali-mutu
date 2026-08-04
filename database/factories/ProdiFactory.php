<?php

namespace Database\Factories;

use App\Models\Prodi;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdiFactory extends Factory
{
    protected $model = Prodi::class;

    public function definition(): array
    {
        return [
            'nama_prodi' => fake()->unique()->words(2, true) . ' Prodi',
            'kode_prodi' => strtoupper(fake()->unique()->bothify('???')),
        ];
    }
}

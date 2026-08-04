<?php

namespace Database\Factories;

use App\Models\DokumenPerkuliahan;
use Illuminate\Database\Eloquent\Factories\Factory;

class DokumenPerkuliahanFactory extends Factory
{
    protected $model = DokumenPerkuliahan::class;

    public function definition(): array
    {
        return [
            'nama_dokumen' => fake()->unique()->words(3, true),
            'sesi' => fake()->numberBetween(1, 4),
            'tenggat_waktu_default' => fake()->numberBetween(1, 30),
            'template' => null,
        ];
    }
}

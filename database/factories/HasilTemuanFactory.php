<?php

namespace Database\Factories;

use App\Models\HasilTemuan;
use App\Models\Subkriteria;
use Illuminate\Database\Eloquent\Factories\Factory;

class HasilTemuanFactory extends Factory
{
    protected $model = HasilTemuan::class;

    public function definition(): array
    {
        return [
            'subkriteria_id' => Subkriteria::factory(),
            'hasil_temuan' => fake()->sentence(),
        ];
    }
}

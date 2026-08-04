<?php

namespace Database\Factories;

use App\Models\Subkriteria;
use App\Models\Kriteria;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubkriteriaFactory extends Factory
{
    protected $model = Subkriteria::class;

    public function definition(): array
    {
        return [
            'kriteria_id' => Kriteria::factory(),
            'kode' => strtoupper(fake()->bothify('???')),
        ];
    }
}

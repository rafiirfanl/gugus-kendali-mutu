<?php

namespace Database\Factories;

use App\Models\TindakLanjut;
use App\Models\HasilTemuan;
use App\Models\Prodi;
use Illuminate\Database\Eloquent\Factories\Factory;

class TindakLanjutFactory extends Factory
{
    protected $model = TindakLanjut::class;

    public function definition(): array
    {
        return [
            'hasil_temuan_id' => HasilTemuan::factory(),
            'prodi_id' => Prodi::factory(),
            'tindak_lanjut' => fake()->sentence(),
            'kendala' => null,
            'masukan' => null,
        ];
    }
}

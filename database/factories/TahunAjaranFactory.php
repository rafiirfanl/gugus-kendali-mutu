<?php

namespace Database\Factories;

use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class TahunAjaranFactory extends Factory
{
    protected $model = TahunAjaran::class;

    public function definition(): array
    {
        $year = fake()->year();
        return [
            'tahun_ajaran' => $year . '/' . ($year + 1),
            'tanggal_mulai_kuliah' => fake()->dateTimeBetween('-1 year', 'now'),
            'jenis' => fake()->randomElement(['Ganjil', 'Genap', 'Pendek']),
            'is_aktif' => false,
        ];
    }

    public function aktif(): static
    {
        return $this->state(fn () => ['is_aktif' => true]);
    }
}

<?php

namespace Database\Factories;

use App\Models\Kelas;
use App\Models\User;
use App\Models\MatkulDibuka;
use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class KelasFactory extends Factory
{
    protected $model = Kelas::class;

    public function definition(): array
    {
        return [
            'nama_kelas' => 'Kelas ' . strtoupper(fake()->bothify('?')),
            'dosen_id' => User::factory(),
            'matkul_dibuka_id' => MatkulDibuka::factory(),
            'tahun_ajaran_id' => TahunAjaran::factory(),
        ];
    }
}

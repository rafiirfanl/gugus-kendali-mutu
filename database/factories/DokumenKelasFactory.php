<?php

namespace Database\Factories;

use App\Models\DokumenKelas;
use App\Models\Kelas;
use App\Models\DokumenPerkuliahan;
use Illuminate\Database\Eloquent\Factories\Factory;

class DokumenKelasFactory extends Factory
{
    protected $model = DokumenKelas::class;

    public function definition(): array
    {
        return [
            'kelas_id' => Kelas::factory(),
            'dokumen_perkuliahan_id' => DokumenPerkuliahan::factory(),
            'file_dokumen' => null,
            'waktu_pengumpulan' => null,
            'status' => 'dikumpulkan',
            'catatan' => null,
        ];
    }

    public function dikumpulkan(): static
    {
        return $this->state(fn () => [
            'status' => 'dikumpulkan',
            'waktu_pengumpulan' => now(),
            'file_dokumen' => 'dokumen_kelas/test.pdf',
        ]);
    }

    public function ditolak(): static
    {
        return $this->state(fn () => [
            'status' => 'ditolak',
            'catatan' => 'Dokumen tidak lengkap',
        ]);
    }
}

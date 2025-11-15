<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TahunAjaran;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TahunAjaran::create([
            'tahun_ajaran' => '2020/2021',
            'jenis' => 'Ganjil',
            'tanggal_mulai_kuliah' => '2020-09-01',
            'is_aktif' => false
        ]);

        TahunAjaran::create([
            'tahun_ajaran' => '2021/2022',
            'jenis' => 'Genap',
            'tanggal_mulai_kuliah' => '2022-02-01',
            'is_aktif' => false
        ]);

        TahunAjaran::create([
            'tahun_ajaran' => '2022/2023',
            'jenis' => 'Pendek',
            'tanggal_mulai_kuliah' => '2022-09-01',
            'is_aktif' => true
        ]);
    }
}

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
            'is_aktif' => true
        ]);

        TahunAjaran::create([
            'tahun_ajaran' => '2021/2022',
            'is_aktif' => true
        ]);

        TahunAjaran::create([
            'tahun_ajaran' => '2022/2023',
            'is_aktif' => true
        ]);
    }
}

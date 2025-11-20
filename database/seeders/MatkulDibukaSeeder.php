<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MatkulDibuka;
use Illuminate\Support\Facades\Hash;

class MatkulDibukaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MatkulDibuka::create([
            'matkul_id' => 1,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 2,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 2,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 2,
        ]);
    }
}

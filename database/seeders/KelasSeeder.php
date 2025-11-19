<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::create([
            'nama_kelas' => 'Kelas RA',
            'dosen_id' => '1',
            'matkul_dibuka_id' => 1,
            'tahun_ajaran_id' => 1,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB',
            'dosen_id' => '2',
            'matkul_dibuka_id' => 2,
            'tahun_ajaran_id' => 1,
        ]);
        
    }
}

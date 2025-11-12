<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Matkul;
use Illuminate\Support\Facades\Hash;

class MatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {  
        Matkul::create([
            'nama_matkul'   => 'Algoritma dan Pemrograman',
            'kode_matkul'   => 'IF101',
            'bobot_sks'     => 3,
            'praktikum'     => 1,
            'prodi_id'      => 1, // Teknik Informatika
        ]);

        Matkul::create([
            'nama_matkul'   => 'Basis Data',
            'kode_matkul'   => 'IF102',
            'bobot_sks'     => 3,
            'praktikum'     => 1,
            'prodi_id'      => 1, // Teknik Informatika
        ]);

        Matkul::create([
            'nama_matkul'   => 'Jaringan Komputer',
            'kode_matkul'   => 'SI201',
            'bobot_sks'     => 3,
            'praktikum'     => 1,
            'prodi_id'      => 2, // Sistem Informasi
        ]);
    }   
}
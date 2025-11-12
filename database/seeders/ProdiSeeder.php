<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prodi;
use Illuminate\Support\Facades\Hash;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {      
        Prodi::create([
            'nama_prodi'    => 'Teknik Informatika',
            'kode_prodi'    => 'TI',
        ]);

        Prodi::create([
            'nama_prodi'    => 'Sistem Informasi',
            'kode_prodi'    => 'SI',
        ]);

        Prodi::create([
            'nama_prodi'    => 'Teknik Elektro',
            'kode_prodi'    => 'TE',
        ]);

        Prodi::create([
            'nama_prodi'    => 'Teknik Fisika',
            'kode_prodi'    => 'TF',
        ]);
    }
}
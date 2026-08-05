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
        $prodiList = [
            ['nama_prodi' => 'Teknik Informatika', 'kode_prodi' => 'IF'],
            ['nama_prodi' => 'Teknik Elektro', 'kode_prodi' => 'EL'],
            ['nama_prodi' => 'Teknik Geofisika', 'kode_prodi' => 'TG'],
            ['nama_prodi' => 'Teknik Geologi', 'kode_prodi' => 'GL'],
            ['nama_prodi' => 'Teknik Mesin', 'kode_prodi' => 'MS'],
            ['nama_prodi' => 'Teknik Industri', 'kode_prodi' => 'TI'],
            ['nama_prodi' => 'Teknik Kimia', 'kode_prodi' => 'TK'],
            ['nama_prodi' => 'Teknik Fisika', 'kode_prodi' => 'TF'],
            ['nama_prodi' => 'Teknik Biosistem', 'kode_prodi' => 'BIO'],
            ['nama_prodi' => 'Teknologi Industri Pertanian', 'kode_prodi' => 'TIP'],
            ['nama_prodi' => 'Teknologi Pangan', 'kode_prodi' => 'TP'],
            ['nama_prodi' => 'Teknik Sistem Energi', 'kode_prodi' => 'SE'],
            ['nama_prodi' => 'Teknik Pertambangan', 'kode_prodi' => 'TPB'],
            ['nama_prodi' => 'Teknik Material', 'kode_prodi' => 'TM'],
            ['nama_prodi' => 'Teknik Telekomunikasi', 'kode_prodi' => 'TL'],
            ['nama_prodi' => 'Rekayasa Kehutanan', 'kode_prodi' => 'RK'],
            ['nama_prodi' => 'Teknik Biomedis', 'kode_prodi' => 'BM'],
            ['nama_prodi' => 'Rekayasa Kosmetik', 'kode_prodi' => 'KOS'],
            ['nama_prodi' => 'Rekayasa Minyak dan Gas', 'kode_prodi' => 'MG'],
            ['nama_prodi' => 'Rekayasa Instrumentasi dan Automasi', 'kode_prodi' => 'IA'],
        ];

        foreach ($prodiList as $prodi) {
            Prodi::create($prodi);
        }

    }
}
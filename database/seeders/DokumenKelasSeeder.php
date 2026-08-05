<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DokumenKelas;
use App\Models\Kelas;
use App\Models\DokumenPerkuliahan;

class DokumenKelasSeeder extends Seeder
{
    public function run(): void
    {
        $kelasList = Kelas::all();
        $dokumenList = DokumenPerkuliahan::all();

        foreach ($kelasList as $kelas) {
            foreach ($dokumenList as $dok) {
                DokumenKelas::create([
                    'kelas_id' => $kelas->id,
                    'dokumen_perkuliahan_id' => $dok->id,
                ]);
            }
        }
    }
}

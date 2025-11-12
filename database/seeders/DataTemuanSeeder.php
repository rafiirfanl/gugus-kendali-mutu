<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\DataTemuan;

class DataTemuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DataTemuan::create([
            'sub_kriteria_id' => 1,
            'hasil_temuan' => 'Temuan A',
            'status_tahun_lalu' => 'Belum Terselesaikan',
            'status_tahun_ini' => 'Terselesaikan',
            'kendala' => 'Kendala A',
            'tindak_lanjut' => 'Tindak Lanjut A',
            'masukkan' => 'Masukkan A',
        ]);

        DataTemuan::create([
            'sub_kriteria_id' => 2,
            'hasil_temuan' => 'Temuan B',
            'status_tahun_lalu' => 'Terselesaikan',
            'status_tahun_ini' => 'Terselesaikan',
            'kendala' => 'Kendala B',
            'tindak_lanjut' => 'Tindak Lanjut B',
            'masukkan' => 'Masukkan B',
        ]);
    }

}

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

        MatkulDibuka::create([
            'matkul_id' => 3,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 4,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 5,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 6,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 7,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 8,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 9,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 10,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 11,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 12,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 13,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 14,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 15,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 16,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 17,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 18,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 19,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 20,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);

        MatkulDibuka::create([
            'matkul_id' => 21,
            'tahun_ajaran_id' => 3,
            'jumlah_kelas' => 1,
        ]);
    }
}

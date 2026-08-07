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
        // Teknik Informatika (sudah ada 2 kelas, tidak perlu ditambah)
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Informatika',
            'dosen_id' => 4,
            'matkul_dibuka_id' => 1,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Informatika',
            'dosen_id' => 4,
            'matkul_dibuka_id' => 2,
            'tahun_ajaran_id' => 3,
        ]);

        // Teknik Elektro
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Elektro',
            'dosen_id' => 77,
            'matkul_dibuka_id' => 3,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Elektro',
            'dosen_id' => 78,
            'matkul_dibuka_id' => 3,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Elektro',
            'dosen_id' => 79,
            'matkul_dibuka_id' => 3,
            'tahun_ajaran_id' => 3,
        ]);

        // Teknik Geofisika
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Geofisika',
            'dosen_id' => 33,
            'matkul_dibuka_id' => 4,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Geofisika',
            'dosen_id' => 34,
            'matkul_dibuka_id' => 4,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Geofisika',
            'dosen_id' => 35,
            'matkul_dibuka_id' => 4,
            'tahun_ajaran_id' => 3,
        ]);

        // Teknik Geologi
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Geologi',
            'dosen_id' => 59,
            'matkul_dibuka_id' => 5,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Geologi',
            'dosen_id' => 60,
            'matkul_dibuka_id' => 5,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Geologi',
            'dosen_id' => 61,
            'matkul_dibuka_id' => 5,
            'tahun_ajaran_id' => 3,
        ]);

        // Teknik Mesin
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Mesin',
            'dosen_id' => 136,
            'matkul_dibuka_id' => 6,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Mesin',
            'dosen_id' => 137,
            'matkul_dibuka_id' => 6,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Mesin',
            'dosen_id' => 138,
            'matkul_dibuka_id' => 6,
            'tahun_ajaran_id' => 3,
        ]);

        // Teknik Industri
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Industri',
            'dosen_id' => 100,
            'matkul_dibuka_id' => 7,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Industri',
            'dosen_id' => 101,
            'matkul_dibuka_id' => 7,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Industri',
            'dosen_id' => 102,
            'matkul_dibuka_id' => 7,
            'tahun_ajaran_id' => 3,
        ]);

        // Teknik Kimia
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Kimia',
            'dosen_id' => 108,
            'matkul_dibuka_id' => 8,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Kimia',
            'dosen_id' => 109,
            'matkul_dibuka_id' => 8,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Kimia',
            'dosen_id' => 110,
            'matkul_dibuka_id' => 8,
            'tahun_ajaran_id' => 3,
        ]);

        // Teknik Fisika
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Fisika',
            'dosen_id' => 158,
            'matkul_dibuka_id' => 9,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Fisika',
            'dosen_id' => 159,
            'matkul_dibuka_id' => 9,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Fisika',
            'dosen_id' => 160,
            'matkul_dibuka_id' => 9,
            'tahun_ajaran_id' => 3,
        ]);

        // Teknik Biosistem
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Biosistem',
            'dosen_id' => 171,
            'matkul_dibuka_id' => 10,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Biosistem',
            'dosen_id' => 171,
            'matkul_dibuka_id' => 10,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Biosistem',
            'dosen_id' => 171,
            'matkul_dibuka_id' => 10,
            'tahun_ajaran_id' => 3,
        ]);

        // Teknologi Industri Pertanian
        Kelas::create([
            'nama_kelas' => 'Kelas RA - TIP',
            'dosen_id' => 172,
            'matkul_dibuka_id' => 11,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - TIP',
            'dosen_id' => 172,
            'matkul_dibuka_id' => 11,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - TIP',
            'dosen_id' => 172,
            'matkul_dibuka_id' => 11,
            'tahun_ajaran_id' => 3,
        ]);

        // Teknologi Pangan
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Pangan',
            'dosen_id' => 173,
            'matkul_dibuka_id' => 12,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Pangan',
            'dosen_id' => 173,
            'matkul_dibuka_id' => 12,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Pangan',
            'dosen_id' => 173,
            'matkul_dibuka_id' => 12,
            'tahun_ajaran_id' => 3,
        ]);

        // Teknik Sistem Energi
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Energi',
            'dosen_id' => 174,
            'matkul_dibuka_id' => 13,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Energi',
            'dosen_id' => 174,
            'matkul_dibuka_id' => 13,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Energi',
            'dosen_id' => 174,
            'matkul_dibuka_id' => 13,
            'tahun_ajaran_id' => 3,
        ]);

        // Teknik Pertambangan
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Pertambangan',
            'dosen_id' => 175,
            'matkul_dibuka_id' => 14,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Pertambangan',
            'dosen_id' => 175,
            'matkul_dibuka_id' => 14,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Pertambangan',
            'dosen_id' => 175,
            'matkul_dibuka_id' => 14,
            'tahun_ajaran_id' => 3,
        ]);

        // Teknik Material
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Material',
            'dosen_id' => 105,
            'matkul_dibuka_id' => 15,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Material',
            'dosen_id' => 105,
            'matkul_dibuka_id' => 15,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Material',
            'dosen_id' => 105,
            'matkul_dibuka_id' => 15,
            'tahun_ajaran_id' => 3,
        ]);

        // Teknik Telekomunikasi
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Telekomunikasi',
            'dosen_id' => 176,
            'matkul_dibuka_id' => 16,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Telekomunikasi',
            'dosen_id' => 176,
            'matkul_dibuka_id' => 16,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Telekomunikasi',
            'dosen_id' => 176,
            'matkul_dibuka_id' => 16,
            'tahun_ajaran_id' => 3,
        ]);

        // Rekayasa Kehutanan
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Kehutanan',
            'dosen_id' => 177,
            'matkul_dibuka_id' => 17,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Kehutanan',
            'dosen_id' => 177,
            'matkul_dibuka_id' => 17,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Kehutanan',
            'dosen_id' => 177,
            'matkul_dibuka_id' => 17,
            'tahun_ajaran_id' => 3,
        ]);

        // Teknik Biomedis
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Biomedis',
            'dosen_id' => 178,
            'matkul_dibuka_id' => 18,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Biomedis',
            'dosen_id' => 178,
            'matkul_dibuka_id' => 18,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Biomedis',
            'dosen_id' => 178,
            'matkul_dibuka_id' => 18,
            'tahun_ajaran_id' => 3,
        ]);

        // Rekayasa Kosmetik
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Kosmetik',
            'dosen_id' => 179,
            'matkul_dibuka_id' => 19,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Kosmetik',
            'dosen_id' => 179,
            'matkul_dibuka_id' => 19,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Kosmetik',
            'dosen_id' => 179,
            'matkul_dibuka_id' => 19,
            'tahun_ajaran_id' => 3,
        ]);

        // Rekayasa Minyak dan Gas
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Migas',
            'dosen_id' => 180,
            'matkul_dibuka_id' => 20,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Migas',
            'dosen_id' => 180,
            'matkul_dibuka_id' => 20,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Migas',
            'dosen_id' => 180,
            'matkul_dibuka_id' => 20,
            'tahun_ajaran_id' => 3,
        ]);

        // Rekayasa Instrumentasi dan Automasi
        Kelas::create([
            'nama_kelas' => 'Kelas RA - Instrumentasi',
            'dosen_id' => 181,
            'matkul_dibuka_id' => 21,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RB - Instrumentasi',
            'dosen_id' => 181,
            'matkul_dibuka_id' => 21,
            'tahun_ajaran_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas RC - Instrumentasi',
            'dosen_id' => 181,
            'matkul_dibuka_id' => 21,
            'tahun_ajaran_id' => 3,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DokumenPerkuliahan;

class DokumenPerkuliahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DokumenPerkuliahan::create([
            'nama_dokumen'          => 'Rencana Pembelajaran Semester',
            'tenggat_waktu_default' => -1,
            'sesi'                  => 1,
            'dikumpulkan_per'       => 0,
            'template'              => null,
        ]);

        DokumenPerkuliahan::create([
            'nama_dokumen'          => 'Materi Perkuliahan',
            'tenggat_waktu_default' => 1,
            'sesi'                  => 1,
            'dikumpulkan_per'       => 0,
            'template'              => null,
        ]);

        DokumenPerkuliahan::create([
            'nama_dokumen'          => 'Modul Praktikum',
            'tenggat_waktu_default' => 1,
            'sesi'                  => 1,
            'dikumpulkan_per'       => 0,
            'template'              => null,
        ]);

        DokumenPerkuliahan::create([
            'nama_dokumen'          => 'Kontrak Kuliah',
            'tenggat_waktu_default' => 2,
            'sesi'                  => 1,
            'dikumpulkan_per'       => 0,
            'template'              => null,
        ]);

        DokumenPerkuliahan::create([
            'nama_dokumen'          => 'Soal Ujian Tengah Semester',
            'tenggat_waktu_default' => 7,
            'sesi'                  => 2,
            'dikumpulkan_per'       => 0,
            'template'              => null,
        ]);

        DokumenPerkuliahan::create([
            'nama_dokumen'          => 'Rubrik Penilaian Ujian Tengah Semester',
            'tenggat_waktu_default' => 7,
            'sesi'                  => 2,
            'dikumpulkan_per'       => 0,
            'template'              => null,
        ]);

        DokumenPerkuliahan::create([
            'nama_dokumen'          => 'Berita Acara Ujian Tengah Semester',
            'tenggat_waktu_default' => 8,
            'sesi'                  => 2,
            'dikumpulkan_per'       => 0,
            'template'              => null,
        ]);

        DokumenPerkuliahan::create([
            'nama_dokumen'          => 'Soal Ujian Akhir Semester',
            'tenggat_waktu_default' => 15,
            'sesi'                  => 3,
            'dikumpulkan_per'       => 0,
            'template'              => null,
        ]);

        DokumenPerkuliahan::create([
            'nama_dokumen'          => 'Rubrik Penilaian Ujian Akhir Semester',
            'tenggat_waktu_default' => 16,
            'sesi'                  => 3,
            'dikumpulkan_per'       => 0,
            'template'              => null,
        ]);

        DokumenPerkuliahan::create([
            'nama_dokumen'          => 'Berita Acara Ujian Akhir Semester',
            'tenggat_waktu_default' => 16,
            'sesi'                  => 3,
            'dikumpulkan_per'       => 0,
            'template'              => null,
        ]);

        DokumenPerkuliahan::create([
            'nama_dokumen'          => 'Berita Acara Perkuliahan',
            'tenggat_waktu_default' => 16,
            'sesi'                  => 3,
            'dikumpulkan_per'       => 0,
            'template'              => null,
        ]);

        DokumenPerkuliahan::create([
            'nama_dokumen'          => 'Presensi Perkuliahan',
            'tenggat_waktu_default' => 16,
            'sesi'                  => 4,
            'dikumpulkan_per'       => 0,
            'template'              => null,
        ]);

        DokumenPerkuliahan::create([
            'nama_dokumen'          => 'Rekap Data Nilai Akhir',
            'tenggat_waktu_default' => 18,
            'sesi'                  => 4,
            'dikumpulkan_per'       => 0,
            'template'              => null,
        ]);

        DokumenPerkuliahan::create([
            'nama_dokumen'          => 'Portofolio Perkuliahan',
            'tenggat_waktu_default' => 20,
            'sesi'                  => 4,
            'dikumpulkan_per'       => 0,
            'template'              => null,
        ]);
    }
}

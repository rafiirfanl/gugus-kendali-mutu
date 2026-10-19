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
        $this->buat([
            'nama_dokumen'          => 'Rencana Pembelajaran Semester',
            'tenggat_waktu_default' => -1,
            'sesi'                  => 1,
            'template'              => null,
        ]);

        $this->buat([
            'nama_dokumen'          => 'Materi Perkuliahan',
            'tenggat_waktu_default' => 1,
            'sesi'                  => 1,
            'template'              => null,
        ]);

        $this->buat([
            'nama_dokumen'          => 'Modul Praktikum',
            'tenggat_waktu_default' => 1,
            'sesi'                  => 1,
            'template'              => null,
        ]);

        $this->buat([
            'nama_dokumen'          => 'Kontrak Kuliah',
            'tenggat_waktu_default' => 2,
            'sesi'                  => 1,
            'template'              => null,
        ]);

        $this->buat([
            'nama_dokumen'          => 'Soal Ujian Tengah Semester',
            'tenggat_waktu_default' => 7,
            'sesi'                  => 2,
            'template'              => null,
        ]);

        $this->buat([
            'nama_dokumen'          => 'Rubrik Penilaian Ujian Tengah Semester',
            'tenggat_waktu_default' => 7,
            'sesi'                  => 2,
            'template'              => null,
        ]);

        $this->buat([
            'nama_dokumen'          => 'Berita Acara Ujian Tengah Semester',
            'tenggat_waktu_default' => 8,
            'sesi'                  => 2,
            'template'              => null,
        ]);

        $this->buat([
            'nama_dokumen'          => 'Soal Ujian Akhir Semester',
            'tenggat_waktu_default' => 15,
            'sesi'                  => 3,
            'template'              => null,
        ]);

        $this->buat([
            'nama_dokumen'          => 'Rubrik Penilaian Ujian Akhir Semester',
            'tenggat_waktu_default' => 16,
            'sesi'                  => 3,
            'template'              => null,
        ]);

        $this->buat([
            'nama_dokumen'          => 'Berita Acara Ujian Akhir Semester',
            'tenggat_waktu_default' => 16,
            'sesi'                  => 3,
            'template'              => null,
        ]);

        $this->buat([
            'nama_dokumen'          => 'Berita Acara Perkuliahan',
            'tenggat_waktu_default' => 16,
            'sesi'                  => 3,
            'template'              => null,
        ]);

        $this->buat([
            'nama_dokumen'          => 'Presensi Perkuliahan',
            'tenggat_waktu_default' => 16,
            'sesi'                  => 4,
            'template'              => null,
        ]);

        $this->buat([
            'nama_dokumen'          => 'Rekap Data Nilai Akhir',
            'tenggat_waktu_default' => 18,
            'sesi'                  => 4,
            'template'              => null,
        ]);

        $this->buat([
            'nama_dokumen'          => 'Portofolio Perkuliahan',
            'tenggat_waktu_default' => 20,
            'sesi'                  => 4,
            'template'              => null,
        ]);
    }

    private function buat(array $data): DokumenPerkuliahan
    {
        return DokumenPerkuliahan::firstOrCreate(['nama_dokumen' => $data['nama_dokumen']], $data);
    }
}

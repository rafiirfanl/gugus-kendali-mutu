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
        $this->buat([
            'nama_matkul'   => 'Algoritma dan Pemrograman',
            'kode_matkul'   => 'IF101',
            'bobot_sks'     => 3,
            'praktikum'     => 1,
            'prodi_id'      => 1,
        ]);

        $this->buat([
            'nama_matkul'   => 'Basis Data',
            'kode_matkul'   => 'IF102',
            'bobot_sks'     => 3,
            'praktikum'     => 1,
            'prodi_id'      => 1,
        ]);

        $this->buat([
            'nama_matkul'   => 'Rangkaian Elektronika',
            'kode_matkul'   => 'EL101',
            'bobot_sks'     => 3,
            'praktikum'     => 1,
            'prodi_id'      => 2,
        ]);

        $this->buat([
            'nama_matkul'   => 'Pengantar Geofisika',
            'kode_matkul'   => 'TG101',
            'bobot_sks'     => 3,
            'praktikum'     => 0,
            'prodi_id'      => 3,
        ]);

        $this->buat([
            'nama_matkul'   => 'Geologi Dasar',
            'kode_matkul'   => 'GL101',
            'bobot_sks'     => 3,
            'praktikum'     => 0,
            'prodi_id'      => 4,
        ]);

        $this->buat([
            'nama_matkul'   => 'Mekanika Teknik',
            'kode_matkul'   => 'MS101',
            'bobot_sks'     => 3,
            'praktikum'     => 0,
            'prodi_id'      => 5,
        ]);

        $this->buat([
            'nama_matkul'   => 'Statistika dan Probabilitas',
            'kode_matkul'   => 'TI101',
            'bobot_sks'     => 3,
            'praktikum'     => 0,
            'prodi_id'      => 6,
        ]);

        $this->buat([
            'nama_matkul'   => 'Kimia Umum',
            'kode_matkul'   => 'TK101',
            'bobot_sks'     => 4,
            'praktikum'     => 1,
            'prodi_id'      => 7,
        ]);

        $this->buat([
            'nama_matkul'   => 'Fisika Dasar',
            'kode_matkul'   => 'TF101',
            'bobot_sks'     => 3,
            'praktikum'     => 1,
            'prodi_id'      => 8,
        ]);

        $this->buat([
            'nama_matkul'   => 'Pengantar Teknik Biosistem',
            'kode_matkul'   => 'BIO101',
            'bobot_sks'     => 3,
            'praktikum'     => 0,
            'prodi_id'      => 9,
        ]);

        $this->buat([
            'nama_matkul'   => 'Pengantar Teknologi Industri Pertanian',
            'kode_matkul'   => 'TIP101',
            'bobot_sks'     => 3,
            'praktikum'     => 0,
            'prodi_id'      => 10,
        ]);

        $this->buat([
            'nama_matkul'   => 'Pengantar Teknologi Pangan',
            'kode_matkul'   => 'TP101',
            'bobot_sks'     => 3,
            'praktikum'     => 1,
            'prodi_id'      => 11,
        ]);

        $this->buat([
            'nama_matkul'   => 'Pengantar Teknik Sistem Energi',
            'kode_matkul'   => 'SE101',
            'bobot_sks'     => 3,
            'praktikum'     => 0,
            'prodi_id'      => 12,
        ]);

        $this->buat([
            'nama_matkul'   => 'Pengantar Teknik Pertambangan',
            'kode_matkul'   => 'TPB101',
            'bobot_sks'     => 3,
            'praktikum'     => 0,
            'prodi_id'      => 13,
        ]);

        $this->buat([
            'nama_matkul'   => 'Pengantar Teknik Material',
            'kode_matkul'   => 'TM101',
            'bobot_sks'     => 3,
            'praktikum'     => 0,
            'prodi_id'      => 14,
        ]);

        $this->buat([
            'nama_matkul'   => 'Pengantar Teknik Telekomunikasi',
            'kode_matkul'   => 'TL101',
            'bobot_sks'     => 3,
            'praktikum'     => 1,
            'prodi_id'      => 15,
        ]);

        $this->buat([
            'nama_matkul'   => 'Pengantar Rekayasa Kehutanan',
            'kode_matkul'   => 'RK101',
            'bobot_sks'     => 3,
            'praktikum'     => 0,
            'prodi_id'      => 16,
        ]);

        $this->buat([
            'nama_matkul'   => 'Pengantar Teknik Biomedis',
            'kode_matkul'   => 'BM101',
            'bobot_sks'     => 3,
            'praktikum'     => 0,
            'prodi_id'      => 17,
        ]);

        $this->buat([
            'nama_matkul'   => 'Pengantar Rekayasa Kosmetik',
            'kode_matkul'   => 'KOS101',
            'bobot_sks'     => 3,
            'praktikum'     => 1,
            'prodi_id'      => 18,
        ]);

        $this->buat([
            'nama_matkul'   => 'Pengantar Rekayasa Minyak dan Gas',
            'kode_matkul'   => 'MG101',
            'bobot_sks'     => 3,
            'praktikum'     => 0,
            'prodi_id'      => 19,
        ]);

        $this->buat([
            'nama_matkul'   => 'Pengantar Rekayasa Instrumentasi dan Automasi',
            'kode_matkul'   => 'IA101',
            'bobot_sks'     => 3,
            'praktikum'     => 1,
            'prodi_id'      => 20,
        ]);
    }

    private function buat(array $data): Matkul
    {
        return Matkul::firstOrCreate(['kode_matkul' => $data['kode_matkul']], $data);
    }
}
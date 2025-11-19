<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DokumenKelas;

class DokumenKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DokumenKelas::create([
            'kelas_id' => 1,
            'dokumen_perkuliahan_id' => 1,
            'file_dokumen' => 'rps_kelas_1.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 1,
            'dokumen_perkuliahan_id' => 2,
            'file_dokumen' => 'rps_kelas_2.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 1,
            'dokumen_perkuliahan_id' => 3,
            'file_dokumen' => 'rps_kelas_3.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 1,
            'dokumen_perkuliahan_id' => 4,
            'file_dokumen' => 'rps_kelas_4.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 1,
            'dokumen_perkuliahan_id' => 5,
            'file_dokumen' => 'rps_kelas_5.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 1,
            'dokumen_perkuliahan_id' => 6,
            'file_dokumen' => 'rps_kelas_6.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 1,
            'dokumen_perkuliahan_id' => 7,
            'file_dokumen' => 'rps_kelas_7.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 1,
            'dokumen_perkuliahan_id' => 8,
            'file_dokumen' => 'rps_kelas_8.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 1,
            'dokumen_perkuliahan_id' => 9,
            'file_dokumen' => 'rps_kelas_9.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 1,
            'dokumen_perkuliahan_id' => 10,
            'file_dokumen' => 'rps_kelas_10.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 1,
            'dokumen_perkuliahan_id' => 11,
            'file_dokumen' => 'rps_kelas_11.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 1,
            'dokumen_perkuliahan_id' => 12,
            'file_dokumen' => 'rps_kelas_12.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 1,
            'dokumen_perkuliahan_id' => 13,
            'file_dokumen' => 'rps_kelas_13.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 1,
            'dokumen_perkuliahan_id' => 14,
            'file_dokumen' => 'rps_kelas_14.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'ditolak',
            'catatan' => 'Perbaiki format penulisan pada bagian tujuan pembelajaran.',
        ]);

        DokumenKelas::create([
            'kelas_id' => 2,
            'dokumen_perkuliahan_id' => 1,
            'file_dokumen' => 'rps_kelas_1.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 2,
            'dokumen_perkuliahan_id' => 2,
            'file_dokumen' => 'rps_kelas_2.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 2,
            'dokumen_perkuliahan_id' => 3,
            'file_dokumen' => 'rps_kelas_3.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 2,
            'dokumen_perkuliahan_id' => 4,
            'file_dokumen' => 'rps_kelas_4.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 2,
            'dokumen_perkuliahan_id' => 5,
            'file_dokumen' => 'rps_kelas_5.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 2,
            'dokumen_perkuliahan_id' => 6,
            'file_dokumen' => 'rps_kelas_6.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 2,
            'dokumen_perkuliahan_id' => 7,
            'file_dokumen' => 'rps_kelas_7.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 2,
            'dokumen_perkuliahan_id' => 8,
            'file_dokumen' => 'rps_kelas_8.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 2,
            'dokumen_perkuliahan_id' => 9,
            'file_dokumen' => 'rps_kelas_9.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 2,
            'dokumen_perkuliahan_id' => 10,
            'file_dokumen' => 'rps_kelas_10.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 2,
            'dokumen_perkuliahan_id' => 11,
            'file_dokumen' => 'rps_kelas_11.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 2,
            'dokumen_perkuliahan_id' => 12,
            'file_dokumen' => 'rps_kelas_12.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
            'catatan' => null,
        ]);

        DokumenKelas::create([
            'kelas_id' => 2,
            'dokumen_perkuliahan_id' => 13,
            'file_dokumen' => 'rps_kelas_13.pdf',
            'waktu_pengumpulan' => now(),
            'status' => 'ditolak',
            'catatan' => 'Perbaiki format penulisan pada bagian tujuan pembelajaran.',
        ]);

        DokumenKelas::create([
            'kelas_id' => 2,
            'dokumen_perkuliahan_id' => 14,
            'file_dokumen' => 'rps_kelas_14.pdf',
            'waktu_pengumpulan' => now()->subDay(),
            'status' => 'ditolak',
            'catatan' => 'Perbaiki format penulisan pada bagian tujuan pembelajaran.',
        ]);
    }
}

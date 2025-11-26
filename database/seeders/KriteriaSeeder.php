<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\HasilTemuan;

class KriteriaSeeder extends Seeder
{
    public function run()
    {
        // ================================
        // DATA STRUKTUR
        // ================================

        $data = [

            // ============================
            // KRITERIA 1
            // ============================
            'KRITERIA 1' => [
                'A1' => [
                    "Tersedia dokumen legal Visi Misi/visi keilmuan dan keterkaitan antara Visi, Misi, Tujuan, dan Sasaran ITERA (SK Fakultas)",
                    "Tersedia dokumen legal Tim Penyusun Visi keilmuan program studi (SK tim penyusun visi keilmuan program studi)",
                    "Tersedia dokumen berita acara/laporan FGD mekanisme penyusunan dan penetapan visi keilmuan dan ada keterlibatan pemangku kepentingan baik internal dan eksternal dalam penyusunan Visi keilmuan",
                    "Tersedia dokumen POS/SOP mekanisme penyusunan dan penetapan visi, misi, tujuan, dan strategi",
                    "Tersedia dokumen (berita acara/dokumentasi/press release di web/bukti kegiatan lain) sosialisasi visi dan misi program studi/fakultas/perguruan tinggi secara sistematis dan berkelanjutan kepada pemangku kepentingan",
                    "Tersedia dokumen (laporan hasil analisis) survei pemahaman visi keilmuan program studi",
                    "Tersedia program kerja (renstra/renop/KAK) program studi yang disusun untuk mendukung pencapaian visi dan misi ITERA",
                    "Visi keilmuan program studi harus memiliki kejelasan, kerealistikan, dan keterkaitan antar visi, misi, tujuan dan sasaran yang terukur dalam kurun waktu tertentu serta mekanisme kontrol ketercapaiannya (Laporan Kinerja Program Studi)"
                ],
            ],

            // ============================
            // KRITERIA 2
            // ============================
            'KRITERIA 2' => [
                'B1' => [
                    "Tersedianya Surat Keputusan pembentukan unit teraudit dan deskripsi tugas, fungsi, wewenang, dan tanggung jawab (SK Pendirian)",
                    "Tersedianya Surat Keputusan Pengangkatan Pejabat dalam lingkungan unit teraudit dan deskripsi tugas, fungsi, wewenang, dan tanggung jawab.",
                    "Adanya bukti rapat perencanaan/persiapan program untuk tahun yang akan berjalan",
                    "Adanya bukti kegiatan rapat evaluasi tiga bulanan untuk mengukur ketercapaian program kerja"
                ],
                'C1' => [
                    "Terdapat laporan tahunan pelaksanaan kerja sama yang minimal mencakup nama kegiatan, mitra kerja sama, lingkup kerja sama, peserta kegiatan, garis besar kegiatan, manfaat yang diterima mitra, waktu pelaksanaan dan lokasi kegiatan"
                ],
                'D1' => [
                    "Memiliki laporan hasil AMI",
                    "Memiliki laporan tindak lanjut AMI",
                    "Memiliki dokumen SPMI",
                    "List Temuan 2023 yang belum ditindaklanjuti"
                ],
            ],

            // ============================
            // KRITERIA 3
            // ============================
            'KRITERIA 3' => [
                'E1' => [
                    "Tersedianya kemudahan akses dan mutu layanan yang baik untuk bidang penalaran, minat bakat mahasiswa, dan layanan kemahasiswaan (kesehatan, beasiswa dll) yang terintegrasi dalam website/aplikasi"
                ],
                'F1' => [
                    "Tersedia laporan kegiatan sosialisasi program studi kepada calon mahasiswa baru"
                ],
            ],

            // ============================
            // KRITERIA 5
            // ============================
            'KRITERIA 5' => [
                'H1' => [
                    "Tersedianya dokumen laporan penggunaan dana untuk operasional (pendidikan, penelitian, pengabdian masyarakat, gaji/upah, investasi sarpras & SDM) (Sheet LKPS 5a)",
                    "Tersedianya Laporan Pertanggungjawaban Kegiatan (Satu tahun)"
                ],
            ],

            // ============================
            // KRITERIA 6
            // ============================
            'KRITERIA 6' => [
                'J1' => [
                    "Dokumen RPS yang memuat keterkaitan CPL, Metode Pembelajaran, Metode Assessment",
                    "Dokumen peninjauan ulang RPS secara berkala dibuktikan dengan terdokumentasi RPS sebelumnya",
                    "Dokumen kontrak kuliah (dilegalkan dan dapat diakses mahasiswa)",
                    "Dokumen materi pembelajaran (ppt/jurnal/buku/blok tematik/dsb)",
                    "Dokumen evaluasi pembelajaran terkait kedalaman & keluasan materi mengacu pada CPL dan dilegalkan (Portofolio)"
                ],
                'K1' => [
                    "Dokumen monitoring kesesuaian pelaksanaan pembelajaran dengan RPS (BAP) dilegalkan GKMP & Kaprodi",
                    "Dokumen validasi soal dan rubrik penilaian dilegalkan sesuai format",
                    "Dokumen portofolio dilegalkan sesuai format",
                    "Dokumen monitoring pelaksanaan pembelajaran"
                ],
                'L1' => [
                    "Laporan Hasil Survei Kepuasan Mahasiswa (EDOM)",
                    "Laporan Tindak Lanjut survei kepuasan mahasiswa (EDOM)",
                    "Dokumen evaluasi pembelajaran",
                    "Buku Kurikulum Program Studi"
                ],
                'M1' => [
                    "Dokumen portofolio dan DNA seluruh mata kuliah pada tahun siklus penilaian",
                    "Laporan tahunan prodi memuat nilai TA, IPK, dan persentase kelulusan",
                    "Contoh jawaban soal mahasiswa terbaik (LJU)"
                ],
                'N1' => [
                    "Buku kurikulum memuat CPL 4 ranah kompetensi",
                    "Berita acara dan laporan FGD kurikulum (keterlibatan stakeholder)",
                    "Sosialisasi buku kurikulum"
                ],
                'O1' => [
                    "Form pendaftaran mahasiswa MBKM",
                    "Surat persetujuan pembimbing akademik",
                    "Surat pengantar MBKM",
                    "Surat pernyataan penerimaan mahasiswa MBKM",
                    "Kontrak konversi / kompetensi kerja"
                ],
                'P1' => [
                    "Log-Book aktivitas harian mahasiswa",
                    "Surat keterangan pembimbing internal & eksternal",
                    "Dokumen monitoring kegiatan MBKM"
                ],
                'Q1' => [
                    "Laporan Kegiatan MBKM",
                    "Transkrip mata kuliah konversi"
                ],
                'S1' => [
                    "Juknis TA dan BAP sosialisasi",
                    "SK dosen pembimbing & penguji TA sesuai kepakaran",
                    "LogBook pembimbingan TA",
                    "Rekapan bentuk TA (jurnal ilmiah, skripsi, dll) dilegalkan / lembar pengesahan",
                    "Bukti juara 1/2/3 BELMAWA"
                ],
                'T1' => [
                    "Dokumen/laporan evaluasi perkuliahan tiap semester",
                    "SK Jabatan Fungsional Dosen",
                    "SK Pengampu Mata Kuliah"
                ],
            ],

            // ============================
            // KRITERIA 9
            // ============================
            'KRITERIA 9' => [
                'Y1' => [
                    "Dokumen laporan/berita acara monev penelitian & pkm sesuai roadmap",
                    "Kegiatan penelitian & pkm dosen/mahasiswa (dibuktikan surat tugas/keterangan LPPM)",
                    "Dokumen hasil penelitian yang diintegrasikan dengan mata kuliah (di RPS & bahan ajar)",
                    "Data penelitian/pkm melibatkan mahasiswa (Laporan Kinerja Tahunan)",
                    "Data luaran HKI: Paten/Paten Sederhana (LKT)",
                    "Data luaran HKI lainnya (Hak Cipta, Desain Industri, PVT, DTLST, dll)",
                    "Data luaran TTG / Produk Terstandarisasi / Sertifikasi / Karya Seni / Rekayasa Sosial",
                    "Buku ber-ISBN / Book Chapter (LKT)",
                    "Dokumen Roadmap penelitian & pkm"
                ],
                'Z1' => [
                    "Dokumen prestasi mahasiswa akademik & non-akademik",
                    "Dokumen IPK & masa studi lulusan",
                    "Koordinasi pengisian tracer study + upaya peningkatan persentase",
                    "Rekap evaluasi CPMK setiap mahasiswa setiap tahun untuk tiap mata kuliah"
                ],
            ],

        ];

        // ================================
        // INSERT DATA
        // ================================
        foreach ($data as $kriteriaNama => $subkriterias) {

            $kriteria = Kriteria::create(['nama' => $kriteriaNama]);

            foreach ($subkriterias as $kode => $hasilList) {

                $sub = Subkriteria::create([
                    'kriteria_id' => $kriteria->id,
                    'kode' => $kode
                ]);

                foreach ($hasilList as $hasil) {
                    HasilTemuan::create([
                        'subkriteria_id' => $sub->id,
                        'hasil_temuan' => $hasil
                    ]);
                }
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gkmf = User::create([
            'name'      => 'Admin GKMF',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmf@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $gkmf->assignRole('gkmf');

        $gkmp = User::create([
            'name'      => 'Admin GKMP IF',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.if@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 1,
        ]);
        $gkmp->assignRole('gkmp');

        $kaprodi = User::create([
            'name'      => 'Andika Setiawan S.Kom., M.Cs.',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'andika.setiawan@if.itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 1,
        ]);
        $kaprodi->assignRole('kaprodi', 'dosen');


        $dosenList = [
            ['name' => 'Eko Dwi Nugroho, S.Kom., M.Cs.', 'email' => 'eko.dwi.nugroho@if.itera.ac.id'],
            ['name' => 'Muhammad Habib Algifari, S.Kom., M.T.I.', 'email' => 'muhammad.habib.algifari@if.itera.ac.id'],
            ['name' => 'Miranti Verdiana, M.Si.', 'email' => 'miranti.verdiana@if.itera.ac.id'],
            ['name' => 'Radhinka Bagaskara, S.Si.Kom., M.Si., M.Sc.', 'email' => 'radhinka.bagaskara@if.itera.ac.id'],
            ['name' => 'Meida Cahyo Untoro, S.Kom., M.Kom', 'email' => 'meida.cahyo.untoro@if.itera.ac.id'],
            ['name' => 'Leslie Anggraini, S.Kom., M.Cs.', 'email' => 'leslie.anggraini@if.itera.ac.id'],
            ['name' => 'Angga Wijaya, S.Si., M.Si.', 'email' => 'angga.wijaya@if.itera.ac.id'],
            ['name' => 'Winda Yulita, M.Cs.', 'email' => 'winda.yulita@if.itera.ac.id'],
            ['name' => 'Ilham Firman Ashari, S.Kom., M.T.', 'email' => 'ilham.firman.ashari@if.itera.ac.id'],
            ['name' => 'Ir. Hira Laksmiwati Soemitro, M.Sc.', 'email' => 'hira.laksmiwati.soemitro@if.itera.ac.id'],
            ['name' => 'Rajif Agung Yunmar, S.Kom., M.Cs.', 'email' => 'rajif.agung.yunmar@if.itera.ac.id'],
            ['name' => 'Raidah Hanifah, S.T., M.T.', 'email' => 'raidah.hanifah@if.itera.ac.id'],
            ['name' => 'Arkham Zahri Rakhman, S.Kom., M.Eng.', 'email' => 'arkham.zahri.rakhman@if.itera.ac.id'],
            ['name' => 'Rahman Indra Kesuma, S.Kom., M.Cs.', 'email' => 'rahman.indra.kesuma@if.itera.ac.id'],
            ['name' => 'Hafiz Budi Firmansyah, S.Kom., M.Sc., Ph.D.', 'email' => 'hafiz.budi.firmansyah@if.itera.ac.id'],
            ['name' => 'I Wayan Wiprayoga Wisesa, S.Kom., M.Kom', 'email' => 'i.wayan.wiprayoga.wisesa@if.itera.ac.id'],
            ['name' => 'Imam Ekowicaksono, S.Si., M.Si.', 'email' => 'imam.ekowicaksono@if.itera.ac.id'],
            ['name' => 'Hartanto Tantriawan, S.Kom., M.Kom.', 'email' => 'hartanto.tantriawan@if.itera.ac.id'],
            ['name' => 'Amirul Iqbal, S.Kom., M.Eng.', 'email' => 'amirul.iqbal@if.itera.ac.id'],
            ['name' => 'Mohamad Idris, S.Si., M.Sc.', 'email' => 'mohamad.idris@if.itera.ac.id'],
            ['name' => 'Arief Ichwani, S.Kom., M.Cs.', 'email' => 'arief.ichwani@if.itera.ac.id'],
            ['name' => 'Martin C.T. Manullang, Ph.D.', 'email' => 'martin.ct.manullang@if.itera.ac.id'],
            ['name' => 'Ir. Mugi Praseptiawan, S.T., M.Kom', 'email' => 'mugi.praseptiawan@if.itera.ac.id'],
            ['name' => 'Andre Febrianto, S.Kom., M.Eng', 'email' => 'andre.febrianto@if.itera.ac.id'],
            ['name' => 'Aidil Afriansyah, S.Kom., M.Kom.', 'email' => 'aidil.afriansyah@if.itera.ac.id'],
            ['name' => 'Prof. Sarwono Sutikno, Dr.Eng., CISA, CISSP, CISM, CSX-F, IIAP, CC', 'email' => 'sarwono.sutikno@if.itera.ac.id'],
            ['name' => 'Alya Khairunnisa Rizkita, S.Kom., M.Kom', 'email' => 'alya.khairunnisa.rizkita@if.itera.ac.id'],
        ];

        foreach ($dosenList as $dosen) {
            $user = User::create([
                'name'      => $dosen['name'],
                'nip'       => '1234567890',
                'ttd'       => 'ttd/ttd.jpeg',
                'email'     => $dosen['email'],
                'password'  => Hash::make('password'),
                'email_verified_at' => now(),
                'prodi_id'  => 1,
            ]);
            $user->assignRole('dosen');
        }


        $gkmp = User::create([
            'name'      => 'Admin GKMP Teknik Geofisika',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.tg@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 3,
        ]);
        $gkmp->assignRole('gkmp');

        $kaprodi = User::create([
            'name'      => 'Kaprodi TG',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'kaprodi.tg@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 3,
        ]);
        $kaprodi->assignRole('kaprodi', 'dosen');

        $dosenListTg = [
            ['name' => 'Purwaditya Nugraha, S.Si., M.T.', 'email' => 'purwaditya.nugraha@tg.itera.ac.id'],
            ['name' => 'Alhada Farduwin, S.T., M.T.', 'email' => 'alhada.farduwin@tg.itera.ac.id'],
            ['name' => 'Wahyu Eko Junian, S.T., M.T.', 'email' => 'wahyu.eko.junian@tg.itera.ac.id'],
            ['name' => 'Selvi Misnia Irawati, S.Si., M.T.', 'email' => 'selvi.misnia.irawati@tg.itera.ac.id'],
            ['name' => 'Asido Saputra Sigalingging, S.T., M.T.', 'email' => 'asido.saputra.sigalingging@tg.itera.ac.id'],
            ['name' => 'Edlyn Yoadan Nathania, S.T., M.T.', 'email' => 'edlyn.yoadan.nathania@tg.itera.ac.id'],
            ['name' => 'Putu Pradnya Andika, M.T.', 'email' => 'putu.pradnya.andika@tg.itera.ac.id'],
            ['name' => 'Yudha Styawan, M.Sc.', 'email' => 'yudha.styawan@tg.itera.ac.id'],
            ['name' => 'Rizki Wulandari, S.T., M.Sc.', 'email' => 'rizki.wulandari@tg.itera.ac.id'],
            ['name' => 'Dr. Nono Agus Santoso, S.Si., M.T.', 'email' => 'nono.agus.santoso@tg.itera.ac.id'],
            ['name' => 'Rizka, S.T., M.T.', 'email' => 'rizka@tg.itera.ac.id'],
            ['name' => 'Risky Martin Antosia, S.Si., M.T.', 'email' => 'risky.martin.antosia@tg.itera.ac.id'],
            ['name' => 'Nugroho Prasetyo, S.T., M.T.', 'email' => 'nugroho.prasetyo@tg.itera.ac.id'],
            ['name' => 'Cahli Suhendi, S.Si., M.T.', 'email' => 'cahli.suhendi@tg.itera.ac.id'],
            ['name' => 'Erlangga Ibrahim Fattah, S.Si., M.T.', 'email' => 'erlangga.ibrahim.fattah@tg.itera.ac.id'],
            ['name' => 'Meta Nisrina Syafitri, S.T., M.T.', 'email' => 'meta.nisrina.syafitri@tg.itera.ac.id'],
            ['name' => 'Dr. Mokhammad Puput E, S.Si., M.T.', 'email' => 'mokhammad.puput.e@tg.itera.ac.id'],
            ['name' => 'Ruhul Firdaus, S.T., M.T.', 'email' => 'ruhul.firdaus@tg.itera.ac.id'],
            ['name' => 'Gestin Mey Ekawati, S.T., M.T.', 'email' => 'gestin.mey.ekawati@tg.itera.ac.id'],
            ['name' => 'Dr. Handoyo, S.Si., M.T.', 'email' => 'handoyo@tg.itera.ac.id'],
            ['name' => 'Harnanti Yogaputri H, S.Si., M.T.', 'email' => 'harnanti.yogaputri.h@tg.itera.ac.id'],
            ['name' => 'Andri Yadi Paembonan, S.Si., M.Sc.', 'email' => 'andri.yadi.paembonan@tg.itera.ac.id'],
            ['name' => 'Intan Andriani Putri, S.Si., M.T.', 'email' => 'intan.andriani.putri@tg.itera.ac.id'],
            ['name' => 'Reza Rizki, S.T., M.T.', 'email' => 'reza.rizki@tg.itera.ac.id'],
        ];

        foreach ($dosenListTg as $dosen) {
            $user = User::create([
                'name'      => $dosen['name'],
                'nip'       => '1234567890',
                'ttd'       => 'ttd/ttd.jpeg',
                'email'     => $dosen['email'],
                'password'  => Hash::make('password'),
                'email_verified_at' => now(),
                'prodi_id'  => 3,
            ]);
            $user->assignRole('dosen');
        }


        $gkmp = User::create([
            'name'      => 'Admin GKMP Geologi',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.gl@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 4,
        ]);
        $gkmp->assignRole('gkmp');

        $kaprodi = User::create([
            'name'      => 'Kaprodi GL',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'kaprodi.gl@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 4,
        ]);
        $kaprodi->assignRole('kaprodi', 'dosen');

        $dosenListGl = [
            ['name' => 'Angga Jati Widiatama, S.T., M.T.', 'email' => 'angga.jati.widiatama@gl.itera.ac.id'],
            ['name' => 'Prof. Dr. Ir. Yahdi Zaim, IPU.', 'email' => 'yahdi.zaim@gl.itera.ac.id'],
            ['name' => 'Dicko Rizky Febriansanu, S.T., M.Eng', 'email' => 'dicko.rizky.febriansanu@gl.itera.ac.id'],
            ['name' => 'Alviyanda, S.T., M.T', 'email' => 'alviyanda@gl.itera.ac.id'],
            ['name' => 'Rikza Nur Faqih An Nahar, S.T., M.T', 'email' => 'rikza.nur.faqih.an.nahar@gl.itera.ac.id'],
            ['name' => 'Dr. Danni Gathot Harbowo, S.Si., M.T.', 'email' => 'danni.gathot.harbowo@gl.itera.ac.id'],
            ['name' => 'Rezki Naufan Hendrawan, S.T., M.T.', 'email' => 'rezki.naufan.hendrawan@gl.itera.ac.id'],
            ['name' => 'Hendra Saputra, S.T., M.T.', 'email' => 'hendra.saputra@gl.itera.ac.id'],
            ['name' => 'Hikhmadhan Gultaf, S.T., M.T.', 'email' => 'hikhmadhan.gultaf@gl.itera.ac.id'],
            ['name' => 'Luhut Pardamean Siringoringo, S.T., M.T.', 'email' => 'luhut.pardamean.siringoringo@gl.itera.ac.id'],
            ['name' => 'Evan Rosyadi Ogara, S.T., M.Eng.', 'email' => 'evan.rosyadi.ogara@gl.itera.ac.id'],
            ['name' => 'Zaki Hilman, S.T., M.T.', 'email' => 'zaki.hilman@gl.itera.ac.id'],
            ['name' => 'Achmad Darul Rochman, S.Pd., M.T.', 'email' => 'achmad.darul.rochman@gl.itera.ac.id'],
            ['name' => 'Bilal Al Farishi, B.Sc(Hons)., M.Sc.', 'email' => 'bilal.al.farishi@gl.itera.ac.id'],
            ['name' => 'Happy Christin Natalia, S.T., M.T.', 'email' => 'happy.christin.natalia@gl.itera.ac.id'],
            ['name' => 'Mochamad Iqbal, S.T., M.T.', 'email' => 'mochamad.iqbal@gl.itera.ac.id'],
        ];

        foreach ($dosenListGl as $dosen) {
            $user = User::create([
                'name'      => $dosen['name'],
                'nip'       => '1234567890',
                'ttd'       => 'ttd/ttd.jpeg',
                'email'     => $dosen['email'],
                'password'  => Hash::make('password'),
                'email_verified_at' => now(),
                'prodi_id'  => 4,
            ]);
            $user->assignRole('dosen');
        }

        $gkmp = User::create([
            'name'      => 'Admin GKMP Teknik Elektro',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.el@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 2,
        ]);
        $gkmp->assignRole('gkmp');

        $kaprodi = User::create([
            'name'      => 'Kaprodi EL',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'kaprodi.el@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 2,
        ]);
        $kaprodi->assignRole('kaprodi', 'dosen');

        $dosenListEl = [
            ['name' => 'Afit Miranto, S.T., M.T.', 'email' => 'afit.miranto@el.itera.ac.id'],
            ['name' => 'Ali Muhtar', 'email' => 'ali.muhtar@el.itera.ac.id'],
            ['name' => 'Dean Corio, S.T., M.T.', 'email' => 'dean.corio@el.itera.ac.id'],
            ['name' => 'Denny Hidayat Tri Nugroho, S.T., M.T.', 'email' => 'denny.hidayat.tri.nugroho@el.itera.ac.id'],
            ['name' => 'Dr. Duwi Hariyanto, S.Si., M.Si.', 'email' => 'duwi.hariyanto@el.itera.ac.id'],
            ['name' => 'Dr. Suratun Nafisah, S.Si., M.Sc.', 'email' => 'suratun.nafisah@el.itera.ac.id'],
            ['name' => 'Dr. Swadexi Istiqphara, S.T., M.T.', 'email' => 'swadexi.istiqphara@el.itera.ac.id'],
            ['name' => 'Efa Maydhona Saputra, S.T., M.T.', 'email' => 'efa.maydhona.saputra@el.itera.ac.id'],
            ['name' => 'Gde KM Atmajaya, S.T., M.T.', 'email' => 'gde.km.atmajaya@el.itera.ac.id'],
            ['name' => 'Harry Yuliansyah, S.T., M.Eng', 'email' => 'harry.yuliansyah@el.itera.ac.id'],
            ['name' => 'Heriansyah, S.T., M.T.', 'email' => 'heriansyah@el.itera.ac.id'],
            ['name' => 'Khansa Salsabila Suhaimi, S.T., M.T.', 'email' => 'khansa.salsabila.suhaimi@el.itera.ac.id'],
            ['name' => 'Kiki Kananda, S.T., M.T.', 'email' => 'kiki.kananda@el.itera.ac.id'],
            ['name' => 'Muhammad Reza Kahar Aziz, S.T., M.T., Ph.D.', 'email' => 'muhammad.reza.kahar.aziz@el.itera.ac.id'],
            ['name' => 'Nia Saputri Utami, M.T.', 'email' => 'nia.saputri.utami@el.itera.ac.id'],
            ['name' => 'Purwono Prasetyawan, S.T., M.T.', 'email' => 'purwono.prasetyawan@el.itera.ac.id'],
            ['name' => 'Rheyuniarto Sahlendar Asthan, S.T., M.T.', 'email' => 'rheyuniarto.sahlendar.asthan@el.itera.ac.id'],
            ['name' => 'Rudi Uswarman, S.T., M.Eng., Ph.D.', 'email' => 'rudi.uswarman@el.itera.ac.id'],
            ['name' => 'Syamsyarief Baqaruzi, S.T., M.T.', 'email' => 'syamsyarief.baqaruzi@el.itera.ac.id'],
            ['name' => 'Tria Kasnalestari, S.T., M.T.', 'email' => 'tria.kasnalestari@el.itera.ac.id'],
            ['name' => 'Uri Arta Ramadhani, S.T., M.Sc.', 'email' => 'uri.arta.ramadhani@el.itera.ac.id'],
        ];

        foreach ($dosenListEl as $dosen) {
            $user = User::create([
                'name'      => $dosen['name'],
                'nip'       => '1234567890',
                'ttd'       => 'ttd/ttd.jpeg',
                'email'     => $dosen['email'],
                'password'  => Hash::make('password'),
                'email_verified_at' => now(),
                'prodi_id'  => 2,
            ]);
            $user->assignRole('dosen');
        }

        $gkmp = User::create([
            'name'      => 'Admin GKMP TI',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.ti@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 6,
        ]);
        $gkmp->assignRole('gkmp');

        $kaprodi = User::create([
            'name'      => 'Kaprodi TI',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'kaprodi.ti@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 6,
        ]);
        $kaprodi->assignRole('kaprodi', 'dosen');

        $dosen = User::create([
            'name'      => 'Dosen Teknik Industri',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'dosen.ti@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 6,
        ]);
        $dosen->assignRole('dosen');

        $gkmp = User::create([
            'name'      => 'Admin GKMP TM',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.tm@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 14,
        ]);
        $gkmp->assignRole('gkmp');

        $kaprodi = User::create([
            'name'      => 'Kaprodi TM',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'kaprodi.tm@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 14,
        ]);
        $kaprodi->assignRole('kaprodi', 'dosen');

        $dosen = User::create([
            'name'      => 'Dosen Teknik Material',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'dosen.tm@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 14,
        ]);
        $dosen->assignRole('dosen');

        $gkmp = User::create([
            'name'      => 'Admin GKMP TK',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.tk@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 7,
        ]);
        $gkmp->assignRole('gkmp');

        $kaprodi = User::create([
            'name'      => 'Kaprodi TK',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'kaprodi.tk@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 7,
        ]);
        $kaprodi->assignRole('kaprodi', 'dosen');

        $dosenListTk = [
            ['name' => 'Ir. Fauzi Yusupandi, S.ST., M.T., IPM ASEAN Eng.', 'email' => 'fauzi.yusupandi@tk.itera.ac.id'],
            ['name' => 'Ir. Mustafa, M.T.', 'email' => 'mustafa@tk.itera.ac.id'],
            ['name' => 'Dr. Eng. Feerzet Achmad, S.T., M.T.', 'email' => 'feerzet.achmad@tk.itera.ac.id'],
            ['name' => 'Reni Yuniarti, S.T., M.T.', 'email' => 'reni.yuniarti@tk.itera.ac.id'],
            ['name' => 'Yunita Fahni, S.T., M.T.', 'email' => 'yunita.fahni@tk.itera.ac.id'],
            ['name' => 'Nina Juliana Roberta Turnip, S.T., M.T.', 'email' => 'nina.juliana.roberta.turnip@tk.itera.ac.id'],
            ['name' => 'Dr. Edwin Rizki Safitra, S.Si., M.Eng.', 'email' => 'edwin.rizki.safitra@tk.itera.ac.id'],
            ['name' => 'Abdul Rozak Kodarif, S.ST., M.T.', 'email' => 'abdul.rozak.kodarif@tk.itera.ac.id'],
            ['name' => 'Calaelma Logys Imalia, S.T., M.T.', 'email' => 'calaelma.logys.imalia@tk.itera.ac.id'],
            ['name' => 'Andri Sanjaya, S.T., M.Eng.', 'email' => 'andri.sanjaya@tk.itera.ac.id'],
            ['name' => 'Putri Zulva Silvia, S.T., M.Eng.', 'email' => 'putri.zulva.silvia@tk.itera.ac.id'],
            ['name' => 'Dewi Qurrota A\'yuni, S.Si., M.T.', 'email' => 'dewi.qurrota.ayuni@tk.itera.ac.id'],
            ['name' => 'Desi Riana Saputri, S.Si., M.T.', 'email' => 'desi.riana.saputri@tk.itera.ac.id'],
            ['name' => 'Misbahudin Alhanif, S.T., M.T.', 'email' => 'misbahudin.alhanif@tk.itera.ac.id'],
            ['name' => 'Lutfia Rahmiyati, S.T., M.T.', 'email' => 'lutfia.rahmiyati@tk.itera.ac.id'],
            ['name' => 'Arysca Wisnu Satria, S.ST., M.Eng.', 'email' => 'arysca.wisnu.satria@tk.itera.ac.id'],
            ['name' => 'Dr. Jabosar Ronggur Hamonangan Panjaitan, S.T., M.T.', 'email' => 'jabosar.ronggur.hamonangan.panjaitan@tk.itera.ac.id'],
            ['name' => 'Damayanti, S.T., M.Sc.', 'email' => 'damayanti@tk.itera.ac.id'],
            ['name' => 'Deviany, S.T., M.Si., Ph.D.', 'email' => 'deviany@tk.itera.ac.id'],
            ['name' => 'Ir. Rifqi Sufra, S.T., M.T.', 'email' => 'rifqi.sufra@tk.itera.ac.id'],
            ['name' => 'Didik Supriyadi, S.T., M.Eng.', 'email' => 'didik.supriyadi@tk.itera.ac.id'],
            ['name' => 'Wika Atro Auriyani, S.T., M.T.', 'email' => 'wika.atro.auriyani@tk.itera.ac.id'],
            ['name' => 'Prof. Dr. Ir. Herri Susanto', 'email' => 'herri.susanto@tk.itera.ac.id'],
            ['name' => 'Pramahadi Febriyanto, S.T., M.T.', 'email' => 'pramahadi.febriyanto@tk.itera.ac.id'],
            ['name' => 'Suryaneta, S.T., M.Sc., Ph.D.', 'email' => 'suryaneta@tk.itera.ac.id'],
            ['name' => 'Deni Subara, S.Si., M.T., Ph.D.', 'email' => 'deni.subara@tk.itera.ac.id'],
        ];

        foreach ($dosenListTk as $dosen) {
            $user = User::create([
                'name'      => $dosen['name'],
                'nip'       => '1234567890',
                'ttd'       => 'ttd/ttd.jpeg',
                'email'     => $dosen['email'],
                'password'  => Hash::make('password'),
                'email_verified_at' => now(),
                'prodi_id'  => 7,
            ]);
            $user->assignRole('dosen');
        }

        $gkmp = User::create([
            'name'      => 'Admin GKMP Teknik Mesin',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.ms@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 5,
        ]);
        $gkmp->assignRole('gkmp');

        $kaprodi = User::create([
            'name'      => 'Kaprodi MS',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'kaprodi.ms@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 5,
        ]);
        $kaprodi->assignRole('kaprodi', 'dosen');

        $dosenListMs = [
            ['name' => 'Dr. Rico Aditia Prahmana, S.T., M.Sc.', 'email' => 'rico.aditia.prahmana@ms.itera.ac.id'],
            ['name' => 'Farid Nanda Syanur, S.T., M.T.', 'email' => 'farid.nanda.syanur@ms.itera.ac.id'],
            ['name' => 'Abdul Muhyi, S.T., M.T.', 'email' => 'abdul.muhyi@ms.itera.ac.id'],
            ['name' => 'Muhammad Syaukani, S.T., M.T.', 'email' => 'muhammad.syaukani@ms.itera.ac.id'],
            ['name' => 'Fajar Paundra, S.T., M.T.', 'email' => 'fajar.paundra@ms.itera.ac.id'],
            ['name' => 'Dr. Kardo Rajagukguk, S.Pd., M.Eng.', 'email' => 'kardo.rajagukguk@ms.itera.ac.id'],
            ['name' => 'Putra Andi Kolala, S.T., M.T.', 'email' => 'putra.andi.kolala@ms.itera.ac.id'],
            ['name' => 'Hadi Teguh Yudistira, S.T., Ph.D.', 'email' => 'hadi.teguh.yudistira@ms.itera.ac.id'],
            ['name' => 'Devia Gahana Cindi Alfian, S.T., M.Sc.', 'email' => 'devia.gahana.cindi.alfian@ms.itera.ac.id'],
            ['name' => 'Fajar Perdana Nurullah, S.T., M.T.', 'email' => 'fajar.perdana.nurullah@ms.itera.ac.id'],
            ['name' => 'Dicky Januarizky Silitonga, S.T., M.Sc.', 'email' => 'dicky.januarizky.silitonga@ms.itera.ac.id'],
            ['name' => 'T.M. Indra Riayatsyah, S.T., M.Eng.Sc.', 'email' => 'tm.indra.riayatsyah@ms.itera.ac.id'],
            ['name' => 'Ir. Eko Pujiyulianto, S.T., M.Eng.', 'email' => 'eko.pujiyulianto@ms.itera.ac.id'],
            ['name' => 'Lathifa Putri Afisna, S.Pd., M.Eng.', 'email' => 'lathifa.putri.afisna@ms.itera.ac.id'],
            ['name' => 'Dr. Aditya Rianjanu, S.Si.', 'email' => 'aditya.rianjanu@ms.itera.ac.id'],
            ['name' => 'Dr. Muhamad Fatikul Arif, S.T., M.Sc.', 'email' => 'muhamad.fatikul.arif@ms.itera.ac.id'],
            ['name' => 'Dr. Nur Istiqomah Khamidy, S.T., M.Sc.', 'email' => 'nur.istiqomah.khamidy@ms.itera.ac.id'],
            ['name' => 'Dr. Eka Nurfani, S.Si., M.Si.', 'email' => 'eka.nurfani@ms.itera.ac.id'],
            ['name' => 'Dr. Jabosar R. H. Panjaitan, S.T., M.T.', 'email' => 'jabosar.r.h.panjaitan@ms.itera.ac.id'],
            ['name' => 'Dr. Sena Maulana, S.Hut., M.Si.', 'email' => 'sena.maulana@ms.itera.ac.id'],
        ];

        foreach ($dosenListMs as $dosen) {
            $user = User::create([
                'name'      => $dosen['name'],
                'nip'       => '1234567890',
                'ttd'       => 'ttd/ttd.jpeg',
                'email'     => $dosen['email'],
                'password'  => Hash::make('password'),
                'email_verified_at' => now(),
                'prodi_id'  => 5,
            ]);
            $user->assignRole('dosen');
        }

        $gkmp = User::create([
            'name'      => 'Admin GKMP Teknik Fisika',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.tf@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 8,
        ]);
        $gkmp->assignRole('gkmp');

        $kaprodi = User::create([
            'name'      => 'Kaprodi TF',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'kaprodi.tf@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 8,
        ]);
        $kaprodi->assignRole('kaprodi', 'dosen');

        $dosenListTf = [
            ['name' => 'Dr. Vera Khoirunisa, S.Si., M.T.', 'email' => 'vera.khoirunisa@tf.itera.ac.id'],
            ['name' => 'Al Barra Harahap, S.Si., M.Si.', 'email' => 'al.barra.harahap@tf.itera.ac.id'],
            ['name' => 'Ferizandi Qauzar Gani, S.T., M.T.', 'email' => 'ferizandi.qauzar.gani@tf.itera.ac.id'],
            ['name' => 'Ahmad Suaif, S.Si., M.Si.', 'email' => 'ahmad.suaif@tf.itera.ac.id'],
            ['name' => 'Septia Eka Marsha Putra, S.Si., M.Eng., Ph.D', 'email' => 'septia.eka.marsha.putra@tf.itera.ac.id'],
            ['name' => 'Amrina Mustaqim, S.Si., M.T.', 'email' => 'amrina.mustaqim@tf.itera.ac.id'],
            ['name' => 'Andam D. Refino, S.T., M.Sc., DIC.', 'email' => 'andam.d.refino@tf.itera.ac.id'],
            ['name' => 'Christio Revano Mege, S.Si., M.T.', 'email' => 'christio.revano.mege@tf.itera.ac.id'],
            ['name' => 'Dr. Aditya Rianjanu, S.Si.', 'email' => 'aditya.rianjanu@tf.itera.ac.id'],
            ['name' => 'Dr. Eka Nurfani, S.Si., M.Sc.', 'email' => 'eka.nurfani@tf.itera.ac.id'],
            ['name' => 'Dr. Muhammad Fatikhul Arif, S.T., M.Sc.', 'email' => 'muhammad.fatikhul.arif@tf.itera.ac.id'],
            ['name' => 'Hadi Teguh Yudistira, S.T., Ph.D.', 'email' => 'hadi.teguh.yudistira@tf.itera.ac.id'],
            ['name' => 'Listra Yehezkiel, S.T., M.Eng', 'email' => 'listra.yehezkiel@tf.itera.ac.id'],
        ];

        foreach ($dosenListTf as $dosen) {
            $user = User::create([
                'name'      => $dosen['name'],
                'nip'       => '1234567890',
                'ttd'       => 'ttd/ttd.jpeg',
                'email'     => $dosen['email'],
                'password'  => Hash::make('password'),
                'email_verified_at' => now(),
                'prodi_id'  => 8,
            ]);
            $user->assignRole('dosen');
        }

        $gkmp = User::create([
            'name'      => 'Admin GKMP Teknik Biosistem',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.bio@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 9,
        ]);
        $gkmp->assignRole('gkmp');

        $gkmp = User::create([
            'name'      => 'Admin GKMP Teknologi Industri Pertanian',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.tip@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 10,
        ]);
        $gkmp->assignRole('gkmp');

        $gkmp = User::create([
            'name'      => 'Admin GKMP Teknologi Pangan',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.tp@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 11,
        ]);
        $gkmp->assignRole('gkmp');

        $gkmp = User::create([
            'name'      => 'Admin GKMP Teknik Sistem Energi',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.se@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 12,
        ]);
        $gkmp->assignRole('gkmp');

        $gkmp = User::create([
            'name'      => 'Admin GKMP Teknik Pertambangan',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.tpb@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 13,
        ]);
        $gkmp->assignRole('gkmp');

        $gkmp = User::create([
            'name'      => 'Admin GKMP Teknik Telekomunikasi',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.tl@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 15,
        ]);
        $gkmp->assignRole('gkmp');

        $dosenDummy = [
            ['name' => 'Dosen Teknik Biosistem', 'email' => 'dosen.bio@itera.ac.id', 'prodi_id' => 9],
            ['name' => 'Dosen Teknologi Industri Pertanian', 'email' => 'dosen.tip@itera.ac.id', 'prodi_id' => 10],
            ['name' => 'Dosen Teknologi Pangan', 'email' => 'dosen.tp@itera.ac.id', 'prodi_id' => 11],
            ['name' => 'Dosen Teknik Sistem Energi', 'email' => 'dosen.se@itera.ac.id', 'prodi_id' => 12],
            ['name' => 'Dosen Teknik Pertambangan', 'email' => 'dosen.tpb@itera.ac.id', 'prodi_id' => 13],
            ['name' => 'Dosen Teknik Telekomunikasi', 'email' => 'dosen.tl@itera.ac.id', 'prodi_id' => 15],
            ['name' => 'Dosen Rekayasa Kehutanan', 'email' => 'dosen.rk@itera.ac.id', 'prodi_id' => 16],
            ['name' => 'Dosen Teknik Biomedis', 'email' => 'dosen.bm@itera.ac.id', 'prodi_id' => 17],
            ['name' => 'Dosen Rekayasa Kosmetik', 'email' => 'dosen.kos@itera.ac.id', 'prodi_id' => 18],
            ['name' => 'Dosen Rekayasa Minyak dan Gas', 'email' => 'dosen.mg@itera.ac.id', 'prodi_id' => 19],
            ['name' => 'Dosen Rekayasa Instrumentasi dan Automasi', 'email' => 'dosen.ia@itera.ac.id', 'prodi_id' => 20],
        ];

        foreach ($dosenDummy as $dosen) {
            $user = User::create([
                'name'      => $dosen['name'],
                'nip'       => '1234567890',
                'ttd'       => 'ttd/ttd.jpeg',
                'email'     => $dosen['email'],
                'password'  => Hash::make('password'),
                'email_verified_at' => now(),
                'prodi_id'  => $dosen['prodi_id'],
            ]);
            $user->assignRole('dosen');
        }
    }
}

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
            'name'      => 'Admin GKMP Geologi',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.gl@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 8,
        ]);
        $gkmp->assignRole('gkmp');

        $kaprodi = User::create([
            'name'      => 'Kaprodi GL',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'kaprodi.gl@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 8,
        ]);
        $kaprodi->assignRole('kaprodi', 'dosen');

        $dosen = User::create([
            'name'      => 'Dosen Geologi',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'dosen.gl@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 8,
        ]);
        $dosen->assignRole('dosen');

        $gkmp = User::create([
            'name'      => 'Admin GKMP SI',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.si@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 2,
        ]);
        $gkmp->assignRole('gkmp');

        $kaprodi = User::create([
            'name'      => 'Kaprodi SI',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'kaprodi.si@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 2,
        ]);
        $kaprodi->assignRole('kaprodi', 'dosen');

        $dosen = User::create([
            'name'      => 'Dosen SI',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'dosen.si@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 2,
        ]);
        $dosen->assignRole('dosen');

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
            'prodi_id'  => 7,
        ]);
        $gkmp->assignRole('gkmp');
        $kaprodi = User::create([
            'name'      => 'Kaprodi TM',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'kaprodi.tm@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 7,
        ]);
        $kaprodi->assignRole('kaprodi', 'dosen');

        $dosen = User::create([
            'name'      => 'Dosen Teknik Mesin',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'dosen.tm@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 7,
        ]);
        $dosen->assignRole('dosen');

        $gkmp = User::create([
            'name'      => 'Admin GKMP TK',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'gkmp.tk@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 5,
        ]);
        $gkmp->assignRole('gkmp');

        $kaprodi = User::create([
            'name'      => 'Kaprodi TK',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'kaprodi.tk@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 5,
        ]);
        $kaprodi->assignRole('kaprodi', 'dosen');

        $dosen = User::create([
            'name'      => 'Dosen Teknik Kimia',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'dosen.tk@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 5,
        ]);
        $dosen->assignRole('dosen');
    }
}

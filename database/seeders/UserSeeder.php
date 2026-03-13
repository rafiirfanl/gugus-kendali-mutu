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


        $dosen = User::create([
            'name'      => 'Dosen IF',
            'nip'       => '1234567890',
            'ttd'       => 'ttd/ttd.jpeg',
            'email'     => 'dosen.if@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 1,
        ]);
        $dosen->assignRole('dosen');


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

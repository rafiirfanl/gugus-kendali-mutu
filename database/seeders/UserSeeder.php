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
        $gkmf=User::create([
            'name'      => 'Admin GKMF',
            'email'     => 'gkmf@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $gkmf->assignRole('gkmf');

        $gkmp=User::create([
            'name'      => 'Admin GKMP',
            'email'     => 'gkmp@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 1,
        ]);
        $gkmp->assignRole('gkmp');

        $kaprodi=User::create([
            'name'      => 'Andika Setiawan S.Kom., M.Cs.',
            'email'     => 'andika.setiawan@if.itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 1,
        ]);
        $kaprodi->assignRole('kaprodi');


        $dosen=User::create([
            'name'      => 'Dosen Dosen',
            'email'     => 'dosen@itera.ac.id',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
            'prodi_id'  => 1,
        ]);
        $dosen->assignRole('dosen');

    }
}
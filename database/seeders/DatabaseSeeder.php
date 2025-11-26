<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleAndPermissionSeeder::class);
        $this->call(TahunAjaranSeeder::class);
        $this->call(ProdiSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MatkulSeeder::class);
        $this->call(MatkulDibukaSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(DataTemuanSeeder::class);
        $this->call(DokumenPerkuliahanSeeder::class);
        $this->call(DokumenKelasSeeder::class);
        $this->call(KriteriaSeeder::class);
    }
}

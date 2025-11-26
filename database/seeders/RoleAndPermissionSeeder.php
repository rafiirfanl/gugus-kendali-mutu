<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        $entities = [
            'dashboard' => ['view'],
            'user' => ['view', 'create', 'edit', 'delete'],
            'role' => ['view', 'create', 'edit', 'delete'],
            'tahun-ajaran' => ['view', 'create', 'edit', 'delete'],
            'prodi' => ['view', 'create', 'edit', 'delete'],
            'matkul' => ['view', 'create', 'edit', 'delete'],
            'dokumen-perkuliahan' => ['view', 'create', 'edit', 'delete'],
            'assignment-dosen' => ['view', 'create', 'edit', 'delete', 'delete-all', 'soft-delete', 'soft-delete-all', 'restore', 'restore-all', 'import', 'export'],
            'progres-kelas' => ['view'],
            'kelas-diampu' => ['view'],
            'submission-dokumen' => ['view', 'upload'],
            'riwayat-dokumen' => ['view', 'edit'],
            'kriteria' => ['view', 'create', 'edit', 'delete'],
            'subkriteria' => ['view', 'create', 'edit', 'delete'],
            'master-data' => ['view'],
        ];

        foreach ($entities as $entity => $actions) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "{$action}:{$entity}"]);
            }
        }

        $roles = [
            'gkmf' => [
                'view:dashboard',
                'view:user',
                'create:user',
                'edit:user',
                'delete:user',
                'view:role',
                'create:role',
                'edit:role',
                'delete:role',
                'view:tahun-ajaran',
                'create:tahun-ajaran',
                'edit:tahun-ajaran',
                'delete:tahun-ajaran',
                'view:prodi',
                'create:prodi',
                'edit:prodi',
                'delete:prodi',
                'view:matkul',
                'create:matkul',
                'edit:matkul',
                'delete:matkul',
                'view:dokumen-perkuliahan',
                'create:dokumen-perkuliahan',
                'edit:dokumen-perkuliahan',
                'delete:dokumen-perkuliahan',
                'view:kriteria',
                'create:kriteria',
                'edit:kriteria',
                'delete:kriteria',
                'view:subkriteria',
                'create:subkriteria',
                'edit:subkriteria',
                'delete:subkriteria',
                'view:master-data',
            ],

            // gkmp
            'gkmp' => [
                'view:dashboard',
                'view:matkul',
                'view:assignment-dosen',
                'create:assignment-dosen',
                'edit:assignment-dosen',
                'delete:assignment-dosen',
                'view:progres-kelas',     
            ],

            // kaprodi 
            'kaprodi' => [
                'view:dashboard',
                'view:matkul',
                'view:assignment-dosen',
                'create:assignment-dosen',
                'edit:assignment-dosen',
                'delete:assignment-dosen',
                'view:progres-kelas',                   
            ],

            // dosen 
            'dosen' => [
                'view:dashboard',
                'view:kelas-diampu',
                'view:submission-dokumen',
                'upload:submission-dokumen',
                'view:riwayat-dokumen',
            ],
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($permissions);
        }
    }
}

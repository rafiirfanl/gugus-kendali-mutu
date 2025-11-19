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
            'tahun-ajaran' => ['view', 'create', 'edit', 'delete', 'delete-all', 'soft-delete', 'soft-delete-all', 'restore', 'restore-all', 'import', 'export'],
            'prodi' => ['view', 'create', 'edit', 'delete', 'delete-all', 'soft-delete', 'soft-delete-all', 'restore', 'restore-all', 'import', 'export'],
            'matkul' => ['view', 'create', 'edit', 'delete', 'delete-all', 'soft-delete', 'soft-delete-all', 'restore', 'restore-all', 'import', 'export'],
            'kelas' => ['view', 'create', 'edit', 'delete', 'delete-all', 'soft-delete', 'soft-delete-all', 'restore', 'restore-all', 'import', 'export'],
            'data-temuan' => ['view', 'create', 'edit', 'delete', 'delete-all', 'soft-delete', 'soft-delete-all', 'restore', 'restore-all', 'import', 'export'],
            'dokumen-perkuliahan' => ['view', 'create', 'edit', 'delete', 'delete-all', 'soft-delete', 'soft-delete-all', 'restore', 'restore-all', 'import', 'export'],
            'assignment-dosen' => ['view', 'create', 'edit', 'delete', 'delete-all', 'soft-delete', 'soft-delete-all', 'restore', 'restore-all', 'import', 'export'],
        ];

        foreach ($entities as $entity => $actions) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "{$action}:{$entity}"]);
            }
        }

        $roles = [
            'gkmf' => \Spatie\Permission\Models\Permission::where('name', 'not like', '%:assignment-dosen%')
                ->pluck('name')
                ->toArray(),

            // gkmp tidak dapat mengelola role atau operasi massal (-all)
            'gkmp' => \Spatie\Permission\Models\Permission::where('name', 'not like', '%:role')
                ->where('name', 'not like', '%-all:%')
                ->pluck('name')
                ->toArray(),

            // kaprodi tidak boleh punya permission apapun yang berkaitan dengan "prodi"
            'kaprodi' => [
                \Spatie\Permission\Models\Permission::where('name', 'not like', '%:prodi%')
                    ->where('name', 'not like', '%-all:%')
                    ->pluck('name')
                    ->toArray(),
            ],

            // dosen hanya bisa mengelola data-temuan
            'dosen' => [
                'view:dashboard',
                'view:data-temuan',
                'create:data-temuan',
                'edit:data-temuan',
                'delete:data-temuan',
            ],
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($permissions);
        }
    }
}

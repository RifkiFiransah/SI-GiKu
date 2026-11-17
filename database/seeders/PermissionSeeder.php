<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['show', 'create', 'update', 'delete'] as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $roles = [
            'ketua' => ['show', 'create', 'update', 'delete'],
            'wakil_ketua' => ['show', 'create', 'update', 'delete'],
            'sekertaris' => ['show', 'create', 'update', 'delete'],
            'bendahara' => ['show', 'create', 'update'],
            'kadiv' => ['show', 'create', 'update'],
            'anggota' => ['show'],
        ];

        foreach ($roles as $name => $permissions) {
            Role::firstOrCreate(['name' => $name])
                ->syncPermissions($permissions);
        }
    }
}

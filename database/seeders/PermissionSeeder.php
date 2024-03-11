<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Permission::create(['name' => 'show']);
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'delete']);

        // Permission::create(['name' => 'show-user']);
        // Permission::create(['name' => 'create-user']);
        // Permission::create(['name' => 'update-user']);
        // Permission::create(['name' => 'delete-user']);

        // Permission::create(['name' => 'show-divisi']);
        // Permission::create(['name' => 'create-divisi']);
        // Permission::create(['name' => 'update-divisi']);
        // Permission::create(['name' => 'delete-divisi']);

        // Permission::create(['name' => 'show-genbi']);
        // Permission::create(['name' => 'create-genbi']);
        // Permission::create(['name' => 'update-genbi']);
        // Permission::create(['name' => 'delete-genbi']);

        // Permission::create(['name' => 'show-proker']);
        // Permission::create(['name' => 'create-proker']);
        // Permission::create(['name' => 'update-proker']);
        // Permission::create(['name' => 'delete-proker']);

        // Permission::create(['name' => 'show-absensi']);
        // Permission::create(['name' => 'create-absensi']);
        // Permission::create(['name' => 'update-absensi']);
        // Permission::create(['name' => 'delete-absensi']);

        $ketua = Role::create(['name' => 'ketua']);
        $ketua->givePermissionTo('show');
        $ketua->givePermissionTo('create');
        $ketua->givePermissionTo('update');
        $ketua->givePermissionTo('delete');
        
        $wakil_ketua = Role::create(['name' => 'wakil_ketua']);
        $wakil_ketua->givePermissionTo('show');
        $wakil_ketua->givePermissionTo('create');
        $wakil_ketua->givePermissionTo('update');
        $wakil_ketua->givePermissionTo('delete');
        
        $sekertaris = Role::create(['name' => 'sekertaris']);
        $sekertaris->givePermissionTo('show');
        $sekertaris->givePermissionTo('create');
        $sekertaris->givePermissionTo('update');
        $sekertaris->givePermissionTo('delete');

        $bendahara = Role::create(['name' => 'bendahara']);
        $bendahara->givePermissionTo('show');
        $bendahara->givePermissionTo('create');

        $anggota = Role::create(['name' => 'anggota']);
        $anggota->givePermissionTo('show');
    }
}

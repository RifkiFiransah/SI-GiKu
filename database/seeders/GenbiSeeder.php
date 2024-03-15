<?php

namespace Database\Seeders;

use App\Models\Genbi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenbiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genbi::insert(
            [
                [
                    'id' => Str::uuid(),
                    'name_genbi' => 'Genbi Cirebon Koordinator Komisariat',
                    'ketua_umum' => 'Taufan Gemilang',
                    'address' => 'Kota Cirebon'
                ],
                [
                    'id' => Str::uuid(),
                    'name_genbi' => 'Genbi IAIN Syekh Nur Jati',
                    'ketua_umum' => '',
                    'address' => 'Kota Cirebon'
                ],
                [
                    'id' => Str::uuid(),
                    'name_genbi' => 'Genbi Universitas Kuningan',
                    'ketua_umum' => 'Alya Naomi',
                    'address' => 'Kabupaten Kuningan'
                ],
            ]
        );
    }
}

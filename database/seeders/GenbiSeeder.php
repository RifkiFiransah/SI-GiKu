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
                    'address' => 'Kota Cirebon'
                ],
                [
                    'id' => Str::uuid(),
                    'name_genbi' => 'Genbi IAIN Syekh Nur Jati',
                    'address' => 'Kota Cirebon'
                ],
                [
                    'id' => Str::uuid(),
                    'name_genbi' => 'Genbi Universitas Kuningan',
                    'address' => 'Kabupaten Kuningan'
                ],
            ]
        );
    }
}

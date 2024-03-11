<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prodi::insert(
            [
                [
                    'id' => Str::uuid(),
                    'name_prodi' => 'Teknik Informatika',
                    'name_fakultas' => 'Fakultas Ilmu Komputer',
                ],
                [
                    'id' => Str::uuid(),
                    'name_prodi' => 'Pendidikan Bahasa Sastra Inggris',
                    'name_fakultas' => 'Fakultas Keguruan dan Ilmu Keguruan',
                ],
            ]
        );
    }
}

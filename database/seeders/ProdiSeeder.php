<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prodies = [
            [
                'name_prodi' => 'Teknik Informatika',
                'name_fakultas' => 'Fakultas Ilmu Komputer',
            ],
            [
                'name_prodi' => 'Pendidikan Bahasa Sastra Inggris',
                'name_fakultas' => 'Fakultas Keguruan dan Ilmu Keguruan',
            ],
            [
                'name_prodi' => 'Pendidikan Matematika',
                'name_fakultas' => 'Fakultas Keguruan dan Ilmu Keguruan',
            ],
            [
                'name_prodi' => 'Manajemen',
                'name_fakultas' => 'Fakultas Ekonomi dan Bisnis',
            ],
            [
                'name_prodi' => 'Sistem Informasi',
                'name_fakultas' => 'Fakultas Ilmu Komputer',
            ],
            [
                'name_prodi' => 'Pendidikan Bahasa Indonesia',
                'name_fakultas' => 'Fakultas Keguruan dan Ilmu Keguruan',
            ],
        ];

        foreach ($prodies as $prodi) {
            Prodi::firstOrCreate(
                ['name_prodi' => $prodi['name_prodi']],
                ['name_fakultas' => $prodi['name_fakultas']]
            );
        }
    }
}

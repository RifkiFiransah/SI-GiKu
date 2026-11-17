<?php

namespace Database\Seeders;

use App\Models\Genbi;
use Illuminate\Database\Seeder;

class GenbiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genbis = [
            [
                'name_genbi' => 'Genbi Cirebon Koordinator Komisariat',
                'ketua_umum' => 'Taufan Gemilang',
                'address' => 'Kota Cirebon',
                'logo' => 'GenBIoriginal.webp',
                'is_current' => false,
            ],
            [
                'name_genbi' => 'Genbi IAIN Syekh Nur Jati',
                'ketua_umum' => 'Dimas Dziarif',
                'address' => 'Kota Cirebon',
                'logo' => 'iain.webp',
                'is_current' => false,
            ],
            [
                'name_genbi' => 'Genbi Universitas Islam Bunga Bangsa Cirebon (UIBBC)',
                'ketua_umum' => 'Imam Syafii',
                'address' => 'Kota Cirebon',
                'logo' => 'uibbc.webp',
                'is_current' => false,
            ],
            [
                'name_genbi' => 'Genbi Universitas Kuningan',
                'ketua_umum' => 'Rifki Firansah',
                'address' => 'Kabupaten Kuningan',
                'logo' => 'uniku.webp',
                'is_current' => true,
            ],
            [
                'name_genbi' => 'Genbi Universitas Majalengka (Unma)',
                'ketua_umum' => 'Riza Maulana',
                'address' => 'Kabupaten Majalengka',
                'logo' => 'unma.webp',
                'is_current' => false,
            ],
            [
                'name_genbi' => 'Genbi Universitas Swadaya Gunung Jati (UGJ)',
                'ketua_umum' => 'Yuda Saputra',
                'address' => 'Kota Cirebon',
                'logo' => 'logo-399-universitas-swadaya-gunung-jati.webp',
                'is_current' => false,
            ],
            [
                'name_genbi' => 'Genbi Universitas Wiralodra (Unwir)',
                'ketua_umum' => 'Dikri Fadillah',
                'address' => 'Kabupaten Indramayu',
                'logo' => 'unwir.webp',
                'is_current' => false,
            ],
        ];

        foreach ($genbis as $genbi) {
            Genbi::updateOrCreate(
                ['name_genbi' => $genbi['name_genbi']],
                $genbi
            );
        }
    }
}

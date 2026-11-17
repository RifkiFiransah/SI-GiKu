<?php

namespace Database\Seeders;

use App\Models\Divisi;
use Illuminate\Database\Seeder;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            'Badan Pengurus Harian',
            'Komunikasi & Informasi',
            'Pendidikan & Pelatihan',
            'Kesehatan',
            'Kewirausahaan',
            'Sosial & Pemberdayaan',
            'Olahraga & Seni',
            'Humas & Relasi',
        ];

        foreach ($divisions as $division) {
            Divisi::firstOrCreate(
                ['name_divisi' => $division],
                ['head' => null]
            );
        }
    }
}

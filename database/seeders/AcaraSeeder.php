<?php

namespace Database\Seeders;

use App\Models\Acara;
use Illuminate\Database\Seeder;

class AcaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $today = now()->startOfDay();
        $acaras = [
            ['name_kegiatan' => 'Genbi Berwirausaha (GeBu)', 'tgl_kegiatan' => $today->copy()->subDays(21)],
            ['name_kegiatan' => 'Genbi Health', 'tgl_kegiatan' => $today->copy()->subDays(14)],
            ['name_kegiatan' => 'Bakti Sosial Ramadan', 'tgl_kegiatan' => $today->copy()->subDays(8)],
            ['name_kegiatan' => 'Roadshow Kampus Uniku', 'tgl_kegiatan' => $today->copy()->subDays(7)],
            ['name_kegiatan' => 'Posko Kesehatan Mudik', 'tgl_kegiatan' => $today->copy()->subDays(1)],
            ['name_kegiatan' => 'Literasi Digital Genbi', 'tgl_kegiatan' => $today->copy()],
            ['name_kegiatan' => 'Donor Darah Genbi', 'tgl_kegiatan' => $today->copy()->addDays(3)],
            ['name_kegiatan' => 'Rapat Koordinasi Awal Genbi Uniku', 'tgl_kegiatan' => $today->copy()->addDays(9)],
        ];

        foreach ($acaras as $acara) {
            Acara::updateOrCreate(
                ['name_kegiatan' => $acara['name_kegiatan']],
                ['tgl_kegiatan' => $acara['tgl_kegiatan']->toDateString()]
            );
        }
    }
}

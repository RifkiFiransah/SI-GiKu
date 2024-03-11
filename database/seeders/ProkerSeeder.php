<?php

namespace Database\Seeders;

use App\Models\Divisi;
use App\Models\Proker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bph = Divisi::where('name_divisi', 'Badan Pengurus Harian')->first();
        $kesehatan = Divisi::where('name_divisi', 'Kesehatan')->first();

        Proker::insert(
            [
                [
                    'id' => Str::uuid(),
                    'name_proker' => 'Genbi Berwirausaha (GeBu)',
                    'description' => 'lorem ipsum dolor sit amet',
                    'tanggal_pelaksanaan' => '2024-03-02',
                    'status' => 'selesai',
                    // 'divisi_id' => $bph->id,
                ],
                [
                    'id' => Str::uuid(),
                    'name_proker' => 'Genbi Health',
                    'description' => 'lorem ipsum dolor sit amet',
                    'tanggal_pelaksanaan' => '2024-04-18',
                    'status' => 'belum',
                    // 'divisi_id' => $kesehatan->id
                ],
            ]
        );
    }
}

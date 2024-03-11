<?php

namespace Database\Seeders;

use App\Models\Divisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Divisi::insert(
            [
                [
                    'id' => Str::uuid(),
                    'name_divisi' => 'Badan Pengurus Harian',
                    'user_id' => null
                ],
                [
                    'id' => Str::uuid(),
                    'name_divisi' => 'Kominfo',
                    'user_id' => null
                ],
                [
                    'id' => Str::uuid(),
                    'name_divisi' => 'Pendidikan',
                    'user_id' => null
                ],
                [
                    'id' => Str::uuid(),
                    'name_divisi' => 'Kesehatan',
                    'user_id' => null
                ],
            ]
        );
    }
}

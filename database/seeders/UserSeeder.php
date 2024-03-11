<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Divisi;
use App\Models\Prodi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bph = Divisi::where('name_divisi', 'Badan Pengurus Harian')->first();
        $kesehatan = Divisi::where('name_divisi', 'Kesehatan')->first();
        $ti = Prodi::where('name_prodi', 'Teknik Informatika')->first();
        $pbsi = Prodi::where('name_prodi', 'Pendidikan Bahasa Sastra Inggris')->first();
        
        $ketua = User::create([
            'id' => Str::uuid(),
            'name' => 'Alya Naomi',
            // 'divisi_id' => $bph->id,
            'address' => 'Kabupaten Kuningan',
            'no_telp' => '0812xxxxx',
            'role' => 'ketua',
            'email' => 'ketua@gmail.com',
            'password' => bcrypt('password123')
        ]);
        $ketua->hasRole('ketua');

        $sekertaris = User::create([
            'id' => Str::uuid(),
            'name' => 'Tiara',
            // 'divisi_id' => $bph->id,
            'address' => 'Kabupaten Kuningan',
            'no_telp' => '0812xxxxx',
            'role' => 'sekertaris',
            'email' => 'sekertaris@gmail.com',
            'password' => bcrypt('password123')
        ]);
        $sekertaris->hasRole('sekertaris');

        $anggota = User::create([
            'id' => Str::uuid(),
            'name' => 'Rifki',
            // 'divisi_id' => $kesehatan->id,
            'address' => 'Kabupaten Kuningan',
            'no_telp' => '0812xxxxx',
            'role' => 'anggota',
            'email' => 'rifki@gmail.com',
            'password' => bcrypt('password123')
        ]);
        $anggota->hasRole('anggota');

    }
}

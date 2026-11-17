<?php

namespace Database\Seeders;

use App\Models\Divisi;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Rifki Firansah', 'role' => 'ketua', 'divisi' => 'Badan Pengurus Harian', 'prodi' => 'Teknik Informatika', 'kota' => 'Kabupaten Kuningan'],
            ['name' => 'Rangga Pratama', 'role' => 'wakil ketua', 'divisi' => 'Badan Pengurus Harian', 'prodi' => 'Manajemen', 'kota' => 'Kota Cirebon'],
            ['name' => 'Tiara Anggraini', 'role' => 'sekertaris', 'divisi' => 'Badan Pengurus Harian', 'prodi' => 'Pendidikan Matematika', 'kota' => 'Kabupaten Kuningan'],
            ['name' => 'Nadia Putri', 'role' => 'bendahara', 'divisi' => 'Badan Pengurus Harian', 'prodi' => 'Manajemen', 'kota' => 'Kabupaten Kuningan'],
            ['name' => 'Dimas Saputra', 'role' => 'kadiv', 'divisi' => 'Komunikasi & Informasi', 'prodi' => 'Sistem Informasi', 'kota' => 'Kota Cirebon'],
            ['name' => 'Salsa Amelia', 'role' => 'kadiv', 'divisi' => 'Pendidikan & Pelatihan', 'prodi' => 'Pendidikan Bahasa Sastra Inggris', 'kota' => 'Kabupaten Kuningan'],
            ['name' => 'Rizky Ramadhan', 'role' => 'kadiv', 'divisi' => 'Kesehatan', 'prodi' => 'Pendidikan Matematika', 'kota' => 'Kabupaten Majalengka'],
            ['name' => 'Farhan Maulana', 'role' => 'kadiv', 'divisi' => 'Kewirausahaan', 'prodi' => 'Manajemen', 'kota' => 'Kota Cirebon'],
            ['name' => 'Putri Maharani', 'role' => 'kadiv', 'divisi' => 'Sosial & Pemberdayaan', 'prodi' => 'Pendidikan Bahasa Sastra Inggris', 'kota' => 'Kabupaten Indramayu'],
            ['name' => 'Bagas Prakoso', 'role' => 'kadiv', 'divisi' => 'Olahraga & Seni', 'prodi' => 'Teknik Informatika', 'kota' => 'Kabupaten Kuningan'],
            ['name' => 'Intan Permata', 'role' => 'kadiv', 'divisi' => 'Humas & Relasi', 'prodi' => 'Manajemen', 'kota' => 'Kota Cirebon'],
            ['name' => 'Aditya Kurnia', 'role' => 'kadiv', 'divisi' => 'Komunikasi & Informasi', 'prodi' => 'Sistem Informasi', 'kota' => 'Kabupaten Kuningan'],
            ['name' => 'Citra Dewi', 'role' => 'anggota', 'divisi' => 'Komunikasi & Informasi', 'prodi' => 'Sistem Informasi', 'kota' => 'Kota Cirebon'],
            ['name' => 'Bima Arya', 'role' => 'anggota', 'divisi' => 'Pendidikan & Pelatihan', 'prodi' => 'Pendidikan Bahasa Sastra Inggris', 'kota' => 'Kabupaten Kuningan'],
            ['name' => 'Nabila Zahra', 'role' => 'anggota', 'divisi' => 'Pendidikan & Pelatihan', 'prodi' => 'Pendidikan Matematika', 'kota' => 'Kabupaten Majalengka'],
            ['name' => 'Yoga Firmansyah', 'role' => 'anggota', 'divisi' => 'Kesehatan', 'prodi' => 'Pendidikan Matematika', 'kota' => 'Kabupaten Kuningan'],
            ['name' => 'Salma Aulia', 'role' => 'anggota', 'divisi' => 'Kesehatan', 'prodi' => 'Teknik Informatika', 'kota' => 'Kota Cirebon'],
            ['name' => 'Reza Ananda', 'role' => 'anggota', 'divisi' => 'Kewirausahaan', 'prodi' => 'Manajemen', 'kota' => 'Kabupaten Indramayu'],
            ['name' => 'Dinda Lestari', 'role' => 'anggota', 'divisi' => 'Kewirausahaan', 'prodi' => 'Sistem Informasi', 'kota' => 'Kabupaten Kuningan'],
            ['name' => 'Arif Hidayat', 'role' => 'anggota', 'divisi' => 'Sosial & Pemberdayaan', 'prodi' => 'Pendidikan Bahasa Sastra Inggris', 'kota' => 'Kabupaten Majalengka'],
            ['name' => 'Mega Silalahi', 'role' => 'anggota', 'divisi' => 'Sosial & Pemberdayaan', 'prodi' => 'Manajemen', 'kota' => 'Kota Cirebon'],
            ['name' => 'Fajar Nugroho', 'role' => 'anggota', 'divisi' => 'Olahraga & Seni', 'prodi' => 'Teknik Informatika', 'kota' => 'Kabupaten Kuningan'],
            ['name' => 'Luna Maharani', 'role' => 'anggota', 'divisi' => 'Olahraga & Seni', 'prodi' => 'Pendidikan Matematika', 'kota' => 'Kabupaten Indramayu'],
            ['name' => 'Gilang Mahendra', 'role' => 'anggota', 'divisi' => 'Humas & Relasi', 'prodi' => 'Sistem Informasi', 'kota' => 'Kota Cirebon'],
        ];

        foreach ($users as $index => $data) {
            $divisiId = Divisi::where('name_divisi', $data['divisi'])->value('id');
            $prodiId = Prodi::where('name_prodi', $data['prodi'])->value('id');
            $email = str_replace(' ', '.', strtolower($data['name'])) . '@genbi.test';

            User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $data['name'],
                    'divisi_id' => $divisiId,
                    'prodi_id' => $prodiId,
                    'address' => $data['kota'] . ', Jawa Barat',
                    'no_telp' => '0812' . str_pad((string) (100000 + $index + 1), 6, '0', STR_PAD_LEFT),
                    'role' => $data['role'],
                    'email_verified_at' => now(),
                    'password' => 'password123',
                ]
            );

            if (in_array($data['role'], ['ketua', 'kadiv'], true) && $divisiId) {
                Divisi::where('id', $divisiId)->update(['head' => $data['name']]);
            }
        }
    }
}

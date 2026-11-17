<?php

namespace Database\Seeders;

use App\Models\Divisi;
use App\Models\Proker;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prokers = [
            ['name' => 'Genbi Berwirausaha (GeBu)', 'divisi' => 'Kewirausahaan', 'user' => 'Farhan Maulana', 'description' => 'Pelatihan wirausaha dan pendampingan UMKM mahasiswa.', 'date' => '2026-02-14', 'status' => 'selesai'],
            ['name' => 'Genbi Health', 'divisi' => 'Kesehatan', 'user' => 'Rizky Ramadhan', 'description' => 'Skrining kesehatan dan edukasi gizi bagi mahasiswa.', 'date' => '2026-03-08', 'status' => 'selesai'],
            ['name' => 'Literasi Digital Genbi', 'divisi' => 'Komunikasi & Informasi', 'user' => 'Dimas Saputra', 'description' => 'Workshop literasi digital dan keamanan siber.', 'date' => '2026-04-21', 'status' => 'sedang berjalan'],
            ['name' => 'Kelas Belajar Bersama', 'divisi' => 'Pendidikan & Pelatihan', 'user' => 'Salsa Amelia', 'description' => 'Kelas tambahan dan pendampingan belajar siswa sekolah menengah.', 'date' => '2026-05-10', 'status' => 'belum'],
            ['name' => 'Bakti Sosial Ramadan', 'divisi' => 'Sosial & Pemberdayaan', 'user' => 'Putri Maharani', 'description' => 'Distribusi paket sembako dan kunjungan panti asuhan.', 'date' => '2026-03-28', 'status' => 'selesai'],
            ['name' => 'Genbi Sport Festival', 'divisi' => 'Olahraga & Seni', 'user' => 'Bagas Prakoso', 'description' => 'Turnamen futsal dan lomba seni antarkomisariat.', 'date' => '2026-06-15', 'status' => 'belum'],
            ['name' => 'Roadshow Kampus Uniku', 'divisi' => 'Humas & Relasi', 'user' => 'Intan Permata', 'description' => 'Sosialisasi program beasiswa di fakultas se-Kuningan.', 'date' => '2026-04-05', 'status' => 'selesai'],
            ['name' => 'Podcast Suara Genbi', 'divisi' => 'Komunikasi & Informasi', 'user' => 'Aditya Kurnia', 'description' => 'Produksi episodik podcast tentang karier dan beasiswa.', 'date' => '2026-05-02', 'status' => 'sedang berjalan'],
            ['name' => 'Pelatihan Public Speaking', 'divisi' => 'Pendidikan & Pelatihan', 'user' => 'Bima Arya', 'description' => 'Latihan penyampaian ide dan komunikasi efektif.', 'date' => '2026-06-22', 'status' => 'belum'],
            ['name' => 'Posko Kesehatan Mudik', 'divisi' => 'Kesehatan', 'user' => 'Yoga Firmansyah', 'description' => 'Layanan kesehatan dan hidrasi di terminal Kuningan.', 'date' => '2026-04-18', 'status' => 'selesai'],
            ['name' => 'Digital Marketing UMKM', 'divisi' => 'Kewirausahaan', 'user' => 'Reza Ananda', 'description' => 'Pendampingan promosi digital untuk mitra UMKM lokal.', 'date' => '2026-07-03', 'status' => 'belum'],
            ['name' => 'Donor Darah Genbi', 'divisi' => 'Kesehatan', 'user' => 'Salma Aulia', 'description' => 'Aksi donor darah bekerja sama dengan PMI Kuningan.', 'date' => '2026-05-30', 'status' => 'sedang berjalan'],
            ['name' => 'Workshop Fotografi', 'divisi' => 'Olahraga & Seni', 'user' => 'Fajar Nugroho', 'description' => 'Pelatihan fotografi dokumenter untuk kegiatan kampus.', 'date' => '2026-07-19', 'status' => 'belum'],
            ['name' => 'Ngobrol Karier Genbi', 'divisi' => 'Humas & Relasi', 'user' => 'Gilang Mahendra', 'description' => 'Diskusi terbuka dengan alumni dan praktisi industri.', 'date' => '2026-06-07', 'status' => 'belum'],
            ['name' => 'Berkah Bersama Anak Yatim', 'divisi' => 'Sosial & Pemberdayaan', 'user' => 'Arif Hidayat', 'description' => 'Kunjungan, sharing, dan bantuan perlengkapan sekolah.', 'date' => '2026-08-01', 'status' => 'belum'],
            ['name' => 'Seminar Kewirausahaan Lanjutan', 'divisi' => 'Kewirausahaan', 'user' => 'Dinda Lestari', 'description' => 'Dibatalkan karena kendala jadwal pembicara.', 'date' => '2026-09-12', 'status' => 'tidak berjalan'],
        ];

        foreach ($prokers as $proker) {
            Proker::updateOrCreate(
                ['name_proker' => $proker['name']],
                [
                    'divisi_id' => Divisi::where('name_divisi', $proker['divisi'])->value('id'),
                    'user_id' => User::where('name', $proker['user'])->value('id'),
                    'description' => $proker['description'],
                    'tanggal_pelaksanaan' => $proker['date'],
                    'status' => $proker['status'],
                ]
            );
        }
    }
}

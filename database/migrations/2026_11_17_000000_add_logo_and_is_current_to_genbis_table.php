<?php

use App\Models\Genbi;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('genbis', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('address');
            $table->boolean('is_current')->default(false)->after('logo');
        });

        $logos = [
            'Universitas Swadaya Gunung Jati' => 'logo-399-universitas-swadaya-gunung-jati.webp',
            'Universitas Wiralodra' => 'unwir.webp',
            'Universitas Majalengka' => 'unma.webp',
            'Universitas Kuningan' => 'uniku.webp',
            'Universitas Islam Bunga Bangsa Cirebon' => 'uibbc.webp',
            'IAIN Syekh Nur Jati' => 'iain.webp',
            'Koordinator Komisariat' => 'GenBIoriginal.webp',
        ];

        foreach ($logos as $needle => $logo) {
            Genbi::query()
                ->where('name_genbi', 'like', '%'.$needle.'%')
                ->whereNull('logo')
                ->update(['logo' => $logo]);
        }

        Genbi::query()
            ->where('name_genbi', 'like', '%Universitas Kuningan%')
            ->update(['is_current' => true]);

        Genbi::query()
            ->where('name_genbi', 'not like', '%Universitas Kuningan%')
            ->update(['is_current' => false]);

        if (! Genbi::query()->where('name_genbi', 'like', '%Koordinator Komisariat%')->exists()) {
            Genbi::query()->create([
                'name_genbi' => 'Genbi Cirebon Koordinator Komisariat',
                'ketua_umum' => 'Taufan Gemilang',
                'address' => 'Kota Cirebon',
                'logo' => 'GenBIoriginal.webp',
                'is_current' => false,
            ]);
        }

        $members = [
            [
                'match' => 'IAIN Syekh Nur Jati',
                'name_genbi' => 'Genbi IAIN Syekh Nur Jati',
                'address' => 'Kota Cirebon',
                'logo' => 'iain.webp',
                'is_current' => false,
            ],
            [
                'match' => 'Islam Bunga Bangsa Cirebon',
                'name_genbi' => 'Genbi Universitas Islam Bunga Bangsa Cirebon (UIBBC)',
                'address' => 'Kota Cirebon',
                'logo' => 'uibbc.webp',
                'is_current' => false,
            ],
            [
                'match' => 'Universitas Kuningan',
                'name_genbi' => 'Genbi Universitas Kuningan',
                'address' => 'Kabupaten Kuningan',
                'logo' => 'uniku.webp',
                'is_current' => true,
            ],
            [
                'match' => 'Universitas Majalengka',
                'name_genbi' => 'Genbi Universitas Majalengka (Unma)',
                'address' => 'Kabupaten Majalengka',
                'logo' => 'unma.webp',
                'is_current' => false,
            ],
            [
                'match' => 'Swadaya Gunung Jati',
                'name_genbi' => 'Genbi Universitas Swadaya Gunung Jati (UGJ)',
                'address' => 'Kota Cirebon',
                'logo' => 'logo-399-universitas-swadaya-gunung-jati.webp',
                'is_current' => false,
            ],
            [
                'match' => 'Universitas Wiralodra',
                'name_genbi' => 'Genbi Universitas Wiralodra (Unwir)',
                'address' => 'Kabupaten Indramayu',
                'logo' => 'unwir.webp',
                'is_current' => false,
            ],
        ];

        foreach ($members as $member) {
            if (Genbi::query()->where('name_genbi', 'like', '%'.$member['match'].'%')->exists()) {
                continue;
            }

            $attributes = $member;
            unset($attributes['match']);

            Genbi::query()->create($attributes);
        }
    }

    public function down(): void
    {
        Schema::table('genbis', function (Blueprint $table) {
            $table->dropColumn(['logo', 'is_current']);
        });
    }
};

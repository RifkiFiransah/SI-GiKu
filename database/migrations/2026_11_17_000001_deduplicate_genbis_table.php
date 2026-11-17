<?php

use App\Models\Genbi;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $matches = [
            'IAIN Syekh Nur Jati',
            'Islam Bunga Bangsa Cirebon',
            'Universitas Kuningan',
            'Universitas Majalengka',
            'Swadaya Gunung Jati',
            'Universitas Wiralodra',
        ];

        foreach ($matches as $match) {
            $rows = Genbi::query()
                ->where('name_genbi', 'like', '%'.$match.'%')
                ->orderBy('created_at')
                ->get();

            if ($rows->count() < 2) {
                continue;
            }

            $keep = $rows->first(fn (Genbi $genbi) => ! empty($genbi->ketua_umum)) ?? $rows->first();
            $deleteIds = $rows->pluck('id')->filter(fn ($id) => $id !== $keep->id)->all();

            if ($deleteIds !== []) {
                Genbi::query()->whereIn('id', $deleteIds)->delete();
            }
        }
    }

    public function down(): void
    {
        //
    }
};

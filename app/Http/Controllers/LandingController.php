<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Genbi;
use App\Models\Proker;
use App\Models\User;

class LandingController extends Controller
{
    private const ROLE_ORDER = ['ketua', 'wakil ketua', 'sekertaris', 'bendahara'];

    public function __invoke()
    {
        $divisis = collect();
        $prokers = collect();
        $divisiNames = collect();
        $pengurus = collect();
        $userNames = collect();
        $komisariats = collect();
        $korkom = null;
        $dataError = false;

        try {
            $divisis = Divisi::query()
                ->with(['user' => fn ($query) => $query->select('id', 'name', 'role', 'divisi_id')->orderBy('name')])
                ->orderBy('name_divisi')
                ->get();
            $prokers = Proker::query()
                ->whereIn('status', ['sedang berjalan', 'selesai'])
                ->orderByDesc('tanggal_pelaksanaan')
                ->get();
            $divisiNames = Divisi::query()->pluck('name_divisi', 'id');
            // Hanya Menampilkan Ketua, Sekertaris, dan Bendahara
            $pengurus = User::query()
                ->get(['id', 'name', 'role', 'divisi_id'])
                ->where('role', '==', 'ketua')
                ->sortBy(function (User $user) {
                    $position = array_search($user->role, self::ROLE_ORDER, true);
                    if ($position === false) {
                        return count(self::ROLE_ORDER);
                    }

                    return $position === false ? count(self::ROLE_ORDER) : $position;
                })
                ->values();
            $userNames = $pengurus->pluck('name', 'id');
            $genbis = Genbi::query()->orderBy('name_genbi')->get();
            $isKorkom = fn (Genbi $genbi) => str_contains(strtolower($genbi->name_genbi), 'koordinator komisariat');
            $korkom = $genbis->first($isKorkom);
            $komisariats = $genbis->reject($isKorkom)->values();
        } catch (\Throwable $exception) {
            report($exception);
            $dataError = true;
        }

        return view('welcome', [
            'divisis' => $divisis,
            'prokers' => $prokers,
            'divisiNames' => $divisiNames,
            'pengurus' => $pengurus,
            'userNames' => $userNames,
            'korkom' => $korkom,
            'komisariats' => $komisariats,
            'dataError' => $dataError,
        ]);
    }
}

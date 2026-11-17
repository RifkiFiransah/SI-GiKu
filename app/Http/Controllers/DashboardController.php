<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Acara;
use App\Models\Divisi;
use App\Models\Genbi;
use App\Models\Proker;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $statusMeta = [
            'belum' => ['label' => 'Belum', 'color' => '#94A3B8'],
            'sedang berjalan' => ['label' => 'Sedang berjalan', 'color' => '#003DA5'],
            'selesai' => ['label' => 'Selesai', 'color' => '#198754'],
            'tidak berjalan' => ['label' => 'Tidak berjalan', 'color' => '#D3262F'],
        ];

        $statusChart = collect($statusMeta)->map(function ($meta, $status) {
            return [
                'label' => $meta['label'],
                'color' => $meta['color'],
                'total' => Proker::where('status', $status)->count(),
            ];
        })->values();

        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $prokerMonths = Proker::whereNotNull('tanggal_pelaksanaan')
            ->get()
            ->groupBy(function ($proker) {
                return Carbon::parse($proker->tanggal_pelaksanaan)->format('Y-m');
            })
            ->sortKeys()
            ->map(function ($items, $key) use ($bulan) {
                $tanggal = Carbon::createFromFormat('Y-m', $key);

                return [
                    'label' => $bulan[$tanggal->month - 1].' '.$tanggal->year,
                    'total' => $items->count(),
                ];
            })
            ->values();

        $stats = [
            [
                'label' => 'Anggota',
                'value' => User::count(),
                'icon' => 'ti-users',
                'color' => 'bg-primary',
                'route' => route('users.index'),
            ],
            [
                'label' => 'Program kerja',
                'value' => Proker::count(),
                'icon' => 'ti-stack-2',
                'color' => 'bg-secondary',
                'route' => route('prokers.index'),
            ],
            [
                'label' => 'Divisi',
                'value' => Divisi::count(),
                'icon' => 'ti-aperture',
                'color' => 'bg-danger',
                'route' => route('divisions.index'),
            ],
            [
                'label' => 'Genbi komisariat',
                'value' => Genbi::count(),
                'icon' => 'ti-world',
                'color' => 'bg-success',
                'route' => route('genbiers.index'),
            ],
        ];

        return view('backend.dashboard', [
            'title' => 'Dashboard',
            'stats' => $stats,
            'statusChart' => $statusChart,
            'prokerMonths' => $prokerMonths,
            'recentProkers' => Proker::with('divisi')
                ->orderByDesc('tanggal_pelaksanaan')
                ->limit(5)
                ->get(),
            'recentAcara' => Acara::orderByDesc('tgl_kegiatan')->limit(3)->get(),
            'absensiCount' => Absensi::count(),
        ]);
    }
}

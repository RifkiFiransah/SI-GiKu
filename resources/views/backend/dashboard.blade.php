@extends('backend.layouts.main')

@section('content')
    <div class="py-3 row">
        @foreach ($stats as $stat)
            <div class="col-md-6 col-xl-3">
                <a href="{{ $stat['route'] }}" class="text-decoration-none">
                    <div class="card card-stats {{ $stat['color'] }} text-light h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <div class="py-3 text-center icon-big">
                                        <i class="ti {{ $stat['icon'] }}" style="font-size: 250%"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <p class="mb-1 card-category">{{ $stat['label'] }}</p>
                                    <h4 class="mb-0 card-title text-light">{{ $stat['value'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-lg-7 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Program kerja per status</h5>
                    <p class="mb-4 text-muted fs-3">Distribusi seluruh program kerja yang tercatat di komisariat.</p>
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <div id="prokerStatusChart"></div>
                        </div>
                        <div class="col-md-5">
                            <ul class="mb-0 list-unstyled">
                                @foreach ($statusChart as $item)
                                    <li class="py-2 d-flex align-items-center justify-content-between border-bottom">
                                        <span class="fs-3">
                                            <span class="round-8 rounded-circle d-inline-block me-2" style="background: {{ $item['color'] }}"></span>
                                            {{ $item['label'] }}
                                        </span>
                                        <span class="fw-semibold">{{ $item['total'] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Program kerja per bulan</h5>
                    <p class="mb-4 text-muted fs-3">Jumlah program kerja berdasarkan tanggal pelaksanaan.</p>
                    @if ($prokerMonths->isNotEmpty())
                        <div id="prokerMonthChart"></div>
                    @else
                        <div class="py-5 text-center text-muted">
                            <i class="ti ti-calendar-off fs-6"></i>
                            <p class="mt-2 mb-0">Belum ada program kerja dengan tanggal pelaksanaan.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="p-4 card-body">
                    <div class="mb-4 d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 card-title fw-semibold">Program kerja terbaru</h5>
                        <a href="{{ route('prokers.index') }}" class="fs-3 text-primary">Lihat semua</a>
                    </div>
                    @if ($recentProkers->isEmpty())
                        <div class="py-5 text-center text-muted">
                            <i class="ti ti-clipboard-list fs-6"></i>
                            <p class="mt-2 mb-0">Belum ada program kerja tercatat.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle text-nowrap">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0"><h6 class="mb-0 fw-semibold">Nama program</h6></th>
                                        <th class="border-bottom-0"><h6 class="mb-0 fw-semibold">Divisi</h6></th>
                                        <th class="border-bottom-0"><h6 class="mb-0 fw-semibold">Status</h6></th>
                                        <th class="border-bottom-0"><h6 class="mb-0 fw-semibold">Tanggal</h6></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentProkers as $proker)
                                        @php
                                            $badges = [
                                                'belum' => 'bg-secondary',
                                                'sedang berjalan' => 'bg-primary',
                                                'selesai' => 'bg-success',
                                                'tidak berjalan' => 'bg-danger',
                                            ];
                                        @endphp
                                        <tr>
                                            <td class="border-bottom-0">
                                                <a href="{{ route('prokers.edit', $proker) }}" class="fw-semibold text-dark text-decoration-none">{{ $proker->name_proker }}</a>
                                            </td>
                                            <td class="border-bottom-0 fs-3">{{ $proker->divisi?->name_divisi ?? 'Belum ditetapkan' }}</td>
                                            <td class="border-bottom-0">
                                                <span class="badge {{ $badges[$proker->status] ?? 'bg-secondary' }} rounded-3 fw-semibold">{{ isset($badges[$proker->status]) ? ucfirst($proker->status) : 'Belum diketahui' }}</span>
                                            </td>
                                            <td class="border-bottom-0 fs-3">{{ $proker->tanggal_pelaksanaan ? \Illuminate\Support\Carbon::parse($proker->tanggal_pelaksanaan)->format('d M Y') : 'Belum ditetapkan' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-5 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="p-4 card-body">
                    <h5 class="card-title fw-semibold">Aktivitas kegiatan</h5>
                    <p class="mb-4 text-muted fs-3">Rekap kegiatan dan absensi yang tercatat.</p>
                    <div class="d-flex align-items-baseline gap-2">
                        <span class="display-6 fw-semibold">{{ $absensiCount }}</span>
                        <span class="text-muted fs-3">data absensi</span>
                    </div>
                    @forelse ($recentAcara as $acara)
                        <div class="pt-3 mt-3 border-top">
                            <h6 class="mb-1 fw-semibold">{{ $acara->name_kegiatan }}</h6>
                            <span class="text-muted fs-3">{{ $acara->tgl_kegiatan }}</span>
                        </div>
                    @empty
                        <div class="pt-3 mt-3 text-muted border-top">
                            <p class="mb-0 fs-3">Belum ada acara tercatat. Tambahkan acara melalui menu absensi kegiatan.</p>
                        </div>
                    @endforelse
                    <a href="{{ route('absensi.index') }}" class="mt-4 btn btn-outline-primary">Kelola absensi</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof ApexCharts === 'undefined') {
                return;
            }

            const statusElement = document.querySelector('#prokerStatusChart');
            const statusData = @json($statusChart);

            if (statusElement && statusData.some((item) => item.total > 0)) {
                new ApexCharts(statusElement, {
                    chart: {
                        type: 'donut',
                        height: 260,
                        toolbar: { show: false },
                        fontFamily: 'inherit'
                    },
                    labels: statusData.map((item) => item.label),
                    colors: statusData.map((item) => item.color),
                    series: statusData.map((item) => item.total),
                    legend: { show: false },
                    dataLabels: {
                        enabled: true,
                        formatter: function (value) {
                            return Number.isFinite(value) ? Math.round(value) + '%' : '0%';
                        }
                    },
                    stroke: { width: 2, colors: ['#ffffff'] },
                    plotOptions: { pie: { donut: { size: '68%' } } },
                    tooltip: { y: { formatter: (value) => value + ' program kerja' } }
                }).render();
            }

            const monthElement = document.querySelector('#prokerMonthChart');
            const monthData = @json($prokerMonths);

            if (monthElement && monthData.length > 0) {
                new ApexCharts(monthElement, {
                    chart: {
                        type: 'bar',
                        height: 260,
                        toolbar: { show: false },
                        fontFamily: 'inherit'
                    },
                    series: [{ name: 'Program kerja', data: monthData.map((item) => item.total) }],
                    categories: monthData.map((item) => item.label),
                    colors: ['#003DA5'],
                    plotOptions: { bar: { borderRadius: 4, columnWidth: '48%' } },
                    dataLabels: { enabled: false },
                    grid: { borderColor: '#E9ECEF', strokeDashArray: 4 },
                    xaxis: { axisBorder: { show: false }, axisTicks: { show: false } },
                    tooltip: { y: { formatter: (value) => value + ' program kerja' } }
                }).render();
            }
        });
    </script>
@endpush

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="SIGIKU, sistem informasi GenBI Universitas Kuningan untuk data anggota, divisi, program kerja, dan absensi kegiatan.">
    <meta name="theme-color" content="#F5F1E8">

    <title>SIGIKU · Sistem Informasi GenBI Universitas Kuningan</title>

    {{-- <link rel="icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}"> --}}
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logos/logo-genbi.webp') }}">
    <link rel="preload" href="{{ asset('assets/fonts/bricolage-grotesque-700.woff2') }}" as="font"
        type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('assets/fonts/plus-jakarta-sans-400.woff2') }}" as="font" type="font/woff2"
        crossorigin>
    <link rel="stylesheet" href="{{ asset('assets/css/icons/tabler-icons/tabler-icons.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen antialiased bg-paper font-body text-ink">
    <a href="#konten"
        class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-[60] focus:bg-ink focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-paper">
        Lewati ke konten
    </a>

    @php
        $navSections = [
            ['id' => 'tentang', 'label' => 'Tentang'],
            ['id' => 'modul', 'label' => 'Modul'],
            ['id' => 'divisi', 'label' => 'Divisi'],
            ['id' => 'korkom', 'label' => 'Korkom'],
            ['id' => 'program-kerja', 'label' => 'Program kerja'],
        ];

        $roleLabels = [
            'ketua' => 'Ketua Umum',
            'wakil ketua' => 'Wakil Ketua',
            'sekertaris' => 'Sekretaris',
            'bendahara' => 'Bendahara',
            'kadiv' => 'Kepala Divisi',
            'anggota' => 'Anggota',
        ];
    @endphp

    <header x-data="{
        open: false,
        active: '',
        scrolled: false,
        sections: ['tentang', 'modul', 'divisi', 'korkom', 'program-kerja'],
        isActive(id) {
            return this.active === id;
        },
        update() {
            this.scrolled = window.scrollY > 8;
            let current = '';
            for (const id of this.sections) {
                const section = document.getElementById(id);
                if (section && section.getBoundingClientRect().top <= 160) {
                    current = id;
                }
            }
            if (window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 2) {
                current = this.sections[this.sections.length - 1];
            }
            this.active = current;
        }
    }" x-init="update()" @scroll.window.passive="update()" @resize.window="update()"
        @keydown.escape.window="open = false" :class="scrolled ? 'border-line' : 'border-transparent'"
        class="sticky top-0 z-50 transition-colors border-b bg-paper">
        <div class="flex items-center justify-between max-w-6xl gap-4 px-5 py-4 mx-auto lg:px-8">
            <a href="#atas" class="flex items-center gap-3 min-h-11">
                <img src="{{ asset('assets/images/logos/logo-genbi.webp') }}" alt="" width="490"
                    height="489" class="object-contain h-9 w-9">
                <span class="leading-none">
                    <span class="block text-lg font-extrabold tracking-tight font-display">SIGIKU</span>
                    <span class="block mt-1 text-xs font-medium text-muted">GenBI UNIKU</span>
                </span>
            </a>

            <nav aria-label="Navigasi utama" class="hidden lg:block">
                <ul class="flex items-center gap-8">
                    @foreach ($navSections as $nav)
                        <li>
                            <a href="#{{ $nav['id'] }}"
                                :class="isActive('{{ $nav['id'] }}') ? 'text-brand' : 'text-ink hover:text-brand'"
                                :aria-current="isActive('{{ $nav['id'] }}') ? 'location' : null"
                                class="relative inline-flex items-center text-xs font-bold tracking-widest uppercase transition-colors group min-h-11 active:text-brand-deep">
                                {{ $nav['label'] }}
                                <span x-show="isActive('{{ $nav['id'] }}')" x-cloak aria-hidden="true"
                                    class="absolute inset-x-0 h-1 -bottom-4 bg-accent"></span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <div class="flex items-center gap-2">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="items-center justify-center hidden px-5 text-sm font-semibold transition-colors border min-h-11 border-brand bg-brand text-paper hover:border-brand-deep hover:bg-brand-deep active:border-ink active:bg-ink lg:inline-flex">
                        Buka dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="items-center justify-center hidden px-5 text-sm font-semibold transition-colors border min-h-11 border-brand bg-brand text-paper hover:border-brand-deep hover:bg-brand-deep active:border-ink active:bg-ink lg:inline-flex">
                        Masuk
                    </a>
                @endauth

                <button type="button" @click="open = !open" :aria-expanded="open ? 'true' : 'false'"
                    aria-controls="menu-mobile"
                    class="inline-flex items-center justify-center transition-colors border h-11 w-11 border-line bg-surface text-ink hover:bg-paper active:bg-line/40 lg:hidden">
                    <span class="sr-only" x-text="open ? 'Tutup menu' : 'Buka menu'">Buka menu</span>
                    <i class="text-2xl ti ti-menu-2" aria-hidden="true" x-show="!open"></i>
                    <i class="text-2xl ti ti-x" aria-hidden="true" x-show="open" x-cloak></i>
                </button>
            </div>
        </div>

        <div id="menu-mobile" x-show="open" x-cloak x-transition.opacity.duration.150ms
            class="border-t border-line bg-paper lg:hidden">
            <nav aria-label="Navigasi seluler" class="max-w-6xl px-5 py-4 mx-auto">
                <ul class="flex flex-col">
                    @foreach ($navSections as $nav)
                        <li>
                            <a href="#{{ $nav['id'] }}" @click="open = false"
                                :class="isActive('{{ $nav['id'] }}') ? 'text-brand' : 'text-ink hover:text-brand'"
                                :aria-current="isActive('{{ $nav['id'] }}') ? 'location' : null"
                                class="flex items-center justify-between py-3 text-sm font-semibold transition-colors border-b min-h-11 border-line active:text-brand-deep">
                                {{ $nav['label'] }}
                                <span x-show="isActive('{{ $nav['id'] }}')" x-cloak aria-hidden="true"
                                    class="h-1.5 w-1.5 bg-accent"></span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-4">
                    @auth
                        <a href="{{ route('dashboard') }}" @click="open = false"
                            class="flex items-center justify-center px-5 text-sm font-semibold transition-colors min-h-11 bg-brand text-paper hover:bg-brand-deep active:bg-ink">
                            Buka dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" @click="open = false"
                            class="flex items-center justify-center px-5 text-sm font-semibold transition-colors min-h-11 bg-brand text-paper hover:bg-brand-deep active:bg-ink">
                            Masuk ke SIGIKU
                        </a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <main id="konten">
        <section id="atas" class="scroll-mt-24">
            <div
                class="grid max-w-6xl gap-12 px-5 pt-12 pb-16 mx-auto lg:grid-cols-12 lg:gap-10 lg:px-8 lg:pb-24 lg:pt-20">
                <div class="lg:col-span-7">
                    <p class="flex items-center gap-3 text-sm font-semibold text-brand">
                        <span aria-hidden="true" class="w-2 h-2 bg-accent"></span>
                        Sistem Informasi GenBI Universitas Kuningan
                    </p>

                    <h1
                        class="mt-6 font-display text-[clamp(2.75rem,6.2vw,5.25rem)] font-extrabold leading-[0.98] tracking-[-0.03em]">
                        Ruang kerja <span class="text-brand">GenBI</span> Universitas Kuningan<span
                            class="text-accent">.</span>
                    </h1>

                    <p class="max-w-xl mt-6 text-base leading-relaxed text-muted sm:text-lg">
                        SIGIKU menyatukan data anggota, divisi, program kerja, dan absensi kegiatan.
                        Satu tempat untuk pengurus dan anggota Komisariat Universitas Kuningan.
                    </p>

                    <div class="flex flex-col gap-3 mt-8 sm:flex-row">
                        @auth
                            <a href="{{ route('dashboard') }}"
                                class="inline-flex items-center justify-center px-6 text-sm font-semibold transition-colors border min-h-11 border-brand bg-brand text-paper hover:border-brand-deep hover:bg-brand-deep active:border-ink active:bg-ink">
                                Buka dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center justify-center px-6 text-sm font-semibold transition-colors border min-h-11 border-brand bg-brand text-paper hover:border-brand-deep hover:bg-brand-deep active:border-ink active:bg-ink">
                                Masuk ke SIGIKU
                            </a>
                        @endauth
                        <a href="#program-kerja"
                            class="inline-flex items-center justify-center px-6 text-sm font-semibold transition-colors border min-h-11 border-ink/25 text-ink hover:border-ink hover:bg-surface">
                            Lihat program kerja
                        </a>
                    </div>

                    <dl class="grid gap-6 pt-6 mt-12 border-t border-line sm:grid-cols-3">
                        <div>
                            <dt class="text-sm font-semibold text-brand">Keanggotaan</dt>
                            <dd class="mt-1 text-sm leading-relaxed text-muted">Data anggota, profil, dan hak akses.
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-semibold text-brand">Organisasi</dt>
                            <dd class="mt-1 text-sm leading-relaxed text-muted">Divisi dan program kerja.</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-semibold text-brand">Kegiatan</dt>
                            <dd class="mt-1 text-sm leading-relaxed text-muted">Absensi, foto, dan resume kegiatan.
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="lg:col-span-5 lg:pl-6">
                    <div class="border border-ink/15 bg-surface p-6 shadow-[8px_8px_0_0_rgba(0,61,165,0.14)] sm:p-8">
                        <div class="flex items-center justify-between gap-4">
                            <p class="text-xs font-semibold text-muted">Identitas komisariat</p>
                            <span aria-hidden="true" class="w-2 h-2 bg-accent"></span>
                        </div>

                        <img src="{{ asset('assets/images/logos/GenBIoriginal.webp') }}" alt="Lambang GenBI Cirebon"
                            width="1423" height="516" fetchpriority="high" class="w-full mt-6">

                        <p class="mt-6 text-2xl font-bold leading-tight font-display">Komisariat Universitas Kuningan
                        </p>
                        <p class="mt-1 text-sm text-muted">Koordinator Komisariat Cirebon</p>

                        <div class="flex items-center gap-4 pt-5 mt-6 border-t border-line">
                            <img src="{{ asset('assets/images/logos/uniku.webp') }}"
                                alt="Lambang Universitas Kuningan" width="300" height="296"
                                class="object-contain h-14 w-14">
                            <div>
                                <p class="text-sm font-semibold">Universitas Kuningan</p>
                                <p class="text-sm text-muted">Kabupaten Kuningan, Jawa Barat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="tentang" class="border-t scroll-mt-24 border-line">
            <div class="grid max-w-6xl gap-10 px-5 py-20 mx-auto lg:grid-cols-12 lg:gap-12 lg:px-8 lg:py-28">
                <div class="lg:col-span-4">
                    <p class="flex items-center gap-3 text-sm font-semibold text-brand">
                        <span aria-hidden="true" class="w-2 h-2 bg-accent"></span>
                        01 · Tentang
                    </p>
                    <h2 class="mt-4 font-display text-3xl font-extrabold leading-[1.05] tracking-tight sm:text-4xl">
                        Satu sistem untuk kerja harian komisariat.
                    </h2>
                </div>

                <div class="lg:col-span-8">
                    <p class="max-w-2xl text-base leading-relaxed text-ink">
                        SIGIKU adalah sistem informasi internal GenBI Universitas Kuningan. Di dalamnya, pengurus
                        mencatat anggota, menyusun divisi, menjalankan program kerja, dan mendokumentasikan absensi
                        kegiatan.
                    </p>
                    <p class="max-w-2xl mt-4 text-base leading-relaxed text-muted">
                        Akses diatur per peran. Ketua, wakil ketua, sekretaris, bendahara, dan anggota membuka data
                        sesuai kewenangannya.
                    </p>

                    <dl class="grid mt-10 gap-x-10 gap-y-6 sm:grid-cols-2">
                        <div class="pt-4 border-t border-line">
                            <dt class="flex items-center gap-2 text-sm font-semibold">
                                <i class="text-base ti ti-shield-check text-brand" aria-hidden="true"></i>
                                Hak akses per peran
                            </dt>
                            <dd class="mt-1 text-sm leading-relaxed text-muted">Kewenangan pengurus dan anggota
                                dipisahkan.</dd>
                        </div>
                        <div class="pt-4 border-t border-line">
                            <dt class="flex items-center gap-2 text-sm font-semibold">
                                <i class="text-base ti ti-id-badge-2 text-brand" aria-hidden="true"></i>
                                Data anggota dan prodi
                            </dt>
                            <dd class="mt-1 text-sm leading-relaxed text-muted">Profil anggota, divisi, dan program
                                studi tercatat.</dd>
                        </div>
                        <div class="pt-4 border-t border-line">
                            <dt class="flex items-center gap-2 text-sm font-semibold">
                                <i class="text-base ti ti-calendar-event text-brand" aria-hidden="true"></i>
                                Program kerja terpantau
                            </dt>
                            <dd class="mt-1 text-sm leading-relaxed text-muted">Status dan tanggal pelaksanaan terlihat
                                jelas.</dd>
                        </div>
                        <div class="pt-4 border-t border-line">
                            <dt class="flex items-center gap-2 text-sm font-semibold">
                                <i class="text-base ti ti-file-spreadsheet text-brand" aria-hidden="true"></i>
                                Ekspor PDF dan Excel
                            </dt>
                            <dd class="mt-1 text-sm leading-relaxed text-muted">Data anggota siap diunduh untuk
                                laporan.</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </section>

        <section id="modul" class="border-t scroll-mt-24 border-line bg-surface">
            <div class="grid max-w-6xl gap-10 px-5 py-20 mx-auto lg:grid-cols-12 lg:gap-12 lg:px-8 lg:py-28">
                <div class="lg:col-span-4">
                    <div class="lg:sticky lg:top-28">
                        <p class="flex items-center gap-3 text-sm font-semibold text-brand">
                            <span aria-hidden="true" class="w-2 h-2 bg-accent"></span>
                            02 · Modul
                        </p>
                        <h2
                            class="mt-4 font-display text-3xl font-extrabold leading-[1.05] tracking-tight sm:text-4xl">
                            Yang bisa dikerjakan pengurus.
                        </h2>
                        <p class="max-w-sm mt-4 text-sm leading-relaxed text-muted">
                            Modul inti untuk kerja harian komisariat, dari pendataan anggota sampai laporan.
                        </p>
                    </div>
                </div>

                <div class="lg:col-span-8">
                    <ol class="border-t border-line">
                        <li
                            class="grid grid-cols-[2.5rem_1fr] gap-x-4 gap-y-3 py-6 sm:grid-cols-[3rem_3rem_1fr] sm:items-start">
                            <span class="pt-2 text-sm font-semibold tabular-nums text-muted">01</span>
                            <span
                                class="flex items-center justify-center w-10 h-10 border border-line bg-paper text-brand">
                                <i class="text-xl ti ti-users" aria-hidden="true"></i>
                            </span>
                            <div class="col-span-2 sm:col-span-1">
                                <h3 class="text-xl font-bold font-display">Keanggotaan</h3>
                                <p class="mt-1 text-sm leading-relaxed text-muted">Data anggota, profil, program studi,
                                    dan hak akses.</p>
                            </div>
                        </li>
                        <li
                            class="grid grid-cols-[2.5rem_1fr] gap-x-4 gap-y-3 border-t border-line py-6 sm:grid-cols-[3rem_3rem_1fr] sm:items-start">
                            <span class="pt-2 text-sm font-semibold tabular-nums text-muted">02</span>
                            <span
                                class="flex items-center justify-center w-10 h-10 border border-line bg-paper text-brand">
                                <i class="text-xl ti ti-sitemap" aria-hidden="true"></i>
                            </span>
                            <div class="col-span-2 sm:col-span-1">
                                <h3 class="text-xl font-bold font-display">Divisi</h3>
                                <p class="mt-1 text-sm leading-relaxed text-muted">Struktur divisi dan ketua divisi
                                    komisariat.</p>
                            </div>
                        </li>
                        <li
                            class="grid grid-cols-[2.5rem_1fr] gap-x-4 gap-y-3 border-t border-line py-6 sm:grid-cols-[3rem_3rem_1fr] sm:items-start">
                            <span class="pt-2 text-sm font-semibold tabular-nums text-muted">03</span>
                            <span
                                class="flex items-center justify-center w-10 h-10 border border-line bg-paper text-brand">
                                <i class="text-xl ti ti-calendar-event" aria-hidden="true"></i>
                            </span>
                            <div class="col-span-2 sm:col-span-1">
                                <h3 class="text-xl font-bold font-display">Program kerja</h3>
                                <p class="mt-1 text-sm leading-relaxed text-muted">Rencana kegiatan, status, dan
                                    tanggal pelaksanaan.</p>
                            </div>
                        </li>
                        <li
                            class="grid grid-cols-[2.5rem_1fr] gap-x-4 gap-y-3 border-t border-line py-6 sm:grid-cols-[3rem_3rem_1fr] sm:items-start">
                            <span class="pt-2 text-sm font-semibold tabular-nums text-muted">04</span>
                            <span
                                class="flex items-center justify-center w-10 h-10 border border-line bg-paper text-brand">
                                <i class="text-xl ti ti-clipboard-check" aria-hidden="true"></i>
                            </span>
                            <div class="col-span-2 sm:col-span-1">
                                <h3 class="text-xl font-bold font-display">Absensi</h3>
                                <p class="mt-1 text-sm leading-relaxed text-muted">Kehadiran anggota, foto, dan resume
                                    kegiatan.</p>
                            </div>
                        </li>
                        <li
                            class="grid grid-cols-[2.5rem_1fr] gap-x-4 gap-y-3 border-t border-line py-6 sm:grid-cols-[3rem_3rem_1fr] sm:items-start">
                            <span class="pt-2 text-sm font-semibold tabular-nums text-muted">05</span>
                            <span
                                class="flex items-center justify-center w-10 h-10 border border-line bg-paper text-brand">
                                <i class="text-xl ti ti-file-spreadsheet" aria-hidden="true"></i>
                            </span>
                            <div class="col-span-2 sm:col-span-1">
                                <h3 class="text-xl font-bold font-display">Laporan</h3>
                                <p class="mt-1 text-sm leading-relaxed text-muted">Ekspor data ke PDF, Excel, dan CSV.
                                </p>
                            </div>
                        </li>
                    </ol>

                    <p class="mt-6 text-sm text-muted">
                        Semua modul tersedia setelah masuk.
                        <a href="{{ route('login') }}"
                            class="font-semibold underline transition-colors text-brand decoration-brand/30 underline-offset-4 hover:decoration-brand">Masuk
                            ke SIGIKU</a>
                    </p>
                </div>
            </div>
        </section>

        <section id="divisi" class="on-dark scroll-mt-24 bg-brand text-paper">
            <div class="grid max-w-6xl gap-10 px-5 py-20 mx-auto lg:grid-cols-12 lg:gap-12 lg:px-8 lg:py-28">
                <div class="lg:col-span-4">
                    <p class="flex items-center gap-3 text-sm font-semibold text-paper/90">
                        <span aria-hidden="true" class="w-2 h-2 bg-paper"></span>
                        03 · Divisi
                    </p>
                    <h2 class="mt-4 font-display text-3xl font-extrabold leading-[1.05] tracking-tight sm:text-4xl">
                        Struktur yang menjalankan kegiatan.
                    </h2>
                    <p class="max-w-md mt-4 text-sm leading-relaxed text-paper/80">
                        Pengurus, ketua divisi, dan anggota tercatat di dalam SIGIKU. Daftar berikut mengikuti data
                        yang tersimpan di sistem.
                    </p>
                </div>

                <div class="lg:col-span-8">
                    @if ($divisis->isNotEmpty() || $pengurus->isNotEmpty())
                        <div class="border-t-2 border-paper/30">
                            {{-- @if ($pengurus->isNotEmpty())
                                <div class="py-10 border-b border-paper/20">
                                    <h3 class="text-[10px] font-bold uppercase tracking-[0.2em] text-paper/60">Pengurus
                                        Komisariat</h3>
                                    <div class="grid grid-cols-2 mt-6 gap-x-8 gap-y-6 sm:grid-cols-3">
                                        @foreach ($pengurus as $orang)
                            <div>
                                <p class="text-xl font-bold leading-tight font-display">
                                    {{ $orang->name }}</p>
                                <p class="mt-1 text-[10px] font-bold uppercase tracking-wider text-paper/50">
                                    {{ $roleLabels[$orang->role] ?? ucfirst($orang->role) }}
                                </p>
                            </div>
                    @endforeach
                </div>
            </div>
            @endif --}}

                            @forelse ($divisis as $divisi)
                                @php
                                    $headName = $divisi->head
                                        ? $userNames[$divisi->head] ??
                                            (\Illuminate\Support\Str::isUuid($divisi->head) ? null : $divisi->head)
                                        : null;
                                @endphp
                                <div class="grid gap-6 py-10 border-b border-paper/20 sm:grid-cols-12">
                                    <div class="sm:col-span-6">
                                        <div class="flex items-baseline gap-4">
                                            <span
                                                class="text-xs font-bold tabular-nums text-paper">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                            <h4
                                                class="text-2xl font-extrabold leading-none tracking-tight font-display">
                                                {{ $divisi->name_divisi }}</h4>
                                        </div>
                                    </div>
                                    <div class="sm:col-span-6">
                                        <div class="mb-5">
                                            <span
                                                class="block text-[10px] font-bold uppercase tracking-[0.15em] text-paper/50">Ketua
                                                Divisi</span>
                                            <span
                                                class="text-lg font-bold">{{ $headName ?: 'Belum ditetapkan' }}</span>
                                        </div>
                                        @if ($divisi->user->isNotEmpty())
                                            <div>
                                                <span
                                                    class="block text-[10px] font-bold uppercase tracking-[0.15em] text-paper/50">Anggota</span>
                                                <ul class="flex flex-wrap mt-3 gap-x-4 gap-y-2">
                                                    @foreach ($divisi->user as $anggota)
                                                        <li class="text-sm font-medium">
                                                            {{ $anggota->name }}
                                                            <span
                                                                class="ml-1 text-[10px] text-paper/50">({{ $roleLabels[$anggota->role] ?? ucfirst($anggota->role) }})</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @else
                                            <p class="text-xs italic font-medium text-paper/40">
                                                Belum ada anggota tercatat. Anggota yang ditambahkan ke divisi ini akan
                                                muncul di sini.
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="py-10 text-sm border-b border-paper/20 text-paper/80">
                                    {{ $dataError ? 'Data divisi sedang tidak dapat dimuat.' : 'Belum ada divisi yang tercatat.' }}
                                </p>
                            @endforelse
                        </div>
                    @else
                        <div class="px-8 py-12 border-2 border-paper/30">
                            <p class="text-2xl font-bold tracking-tight font-display">
                                {{ $dataError ? 'Data struktur sedang tidak dapat dimuat.' : 'Belum ada pengurus atau divisi yang tercatat.' }}
                            </p>
                            <p class="mt-4 text-sm leading-relaxed text-paper/70">
                                {{ $dataError ? 'Coba muat ulang halaman ini beberapa saat lagi.' : 'Pengurus dan divisi yang ditambahkan akan muncul di bagian ini.' }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <section id="korkom" class="bg-white border-t border-line scroll-mt-24">
            <div class="grid max-w-6xl gap-10 px-5 py-20 mx-auto lg:grid-cols-12 lg:gap-12 lg:px-8 lg:py-28">
                <div class="lg:col-span-4">
                    <p class="flex items-center gap-3 text-sm font-semibold text-brand">
                        <span aria-hidden="true" class="w-2 h-2 bg-accent"></span>
                        04 · Korkom
                    </p>
                    <h2 class="mt-4 font-display text-3xl font-extrabold leading-[1.05] tracking-tight sm:text-4xl">
                        Koordinator Komisariat Cirebon.
                    </h2>
                    <p class="max-w-md mt-4 text-sm leading-relaxed text-muted">
                        Komisariat anggota Korkom Cirebon bergerak bersama dalam satu koordinasi wilayah.
                    </p>

                    @if ($korkom)
                        <div class="p-6 mt-8 border border-line bg-paper">
                            <p class="text-xs font-semibold text-muted">Ketua Korkom Cirebon</p>
                            <p class="mt-2 text-2xl font-bold leading-tight font-display">
                                {{ $korkom->ketua_umum ?: 'Belum ditetapkan' }}
                            </p>
                            @if ($korkom->address)
                                <p class="mt-1 text-sm text-muted">{{ $korkom->address }}</p>
                            @endif
                        </div>
                    @elseif ($dataError)
                        <p class="mt-8 text-sm text-muted">Data ketua korkom sedang tidak dapat dimuat.</p>
                    @endif
                </div>

                <div class="lg:col-span-8">
                    <div class="flex items-baseline justify-between gap-4 pb-6 border-b-2 border-line">
                        <h3 class="text-[10px] font-bold uppercase tracking-[0.2em] text-muted">Komisariat Anggota</h3>
                        <p class="text-xs font-bold text-muted">{{ $komisariats->count() }} KOMISARIAT</p>
                    </div>

                    <div class="grid gap-x-12 sm:grid-cols-2">
                        @forelse ($komisariats as $komisariat)
                            <div class="relative py-8 border-b group border-line">
                                <div class="flex items-start gap-4">
                                    <span
                                        class="text-4xl font-extrabold leading-none tracking-tighter transition-colors font-display text-line group-hover:text-accent/20">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                    @if ($komisariat->logo_url)
                                        <img src="{{ $komisariat->logo_url }}"
                                            alt="Lambang {{ $komisariat->name_genbi }}" width="56"
                                            height="56" class="object-contain w-12 h-12 sm:w-14 sm:h-14 shrink-0">
                                    @endif
                                    <div>
                                        <h4 class="text-xl font-bold leading-tight tracking-tight font-display">
                                            {{ $komisariat->name_genbi }}
                                        </h4>
                                        <p class="mt-1 text-xs font-bold tracking-widest uppercase text-muted/60">
                                            {{ $komisariat->address }}</p>

                                        @if ($komisariat->is_current)
                                            <div class="mt-3">
                                                <span
                                                    class="inline-flex items-center gap-1.5 border border-accent/20 bg-accent/5 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-accent">
                                                    <span aria-hidden="true" class="w-1 h-1 bg-accent"></span>
                                                    Komisariat Ini
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="py-10 border-b border-line sm:col-span-2">
                                <p class="text-sm text-muted">
                                    {{ $dataError ? 'Data komisariat sedang tidak dapat dimuat.' : 'Belum ada komisariat anggota yang tercatat.' }}
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <section id="program-kerja" class="scroll-mt-24">
            <div class="max-w-6xl px-5 py-20 mx-auto lg:px-8 lg:py-28">
                <div class="grid gap-6 lg:grid-cols-12 lg:items-end">
                    <div class="lg:col-span-8">
                        <p class="flex items-center gap-3 text-sm font-semibold text-brand">
                            <span aria-hidden="true" class="w-2 h-2 bg-accent"></span>
                            05 · Program kerja
                        </p>
                        <h2
                            class="mt-4 font-display text-3xl font-extrabold leading-[1.05] tracking-tight sm:text-4xl">
                            Program kerja komisariat.
                        </h2>
                        <p class="max-w-2xl mt-4 text-base leading-relaxed text-muted">
                            Hanya program kerja yang sedang berjalan dan selesai yang ditampilkan. Pilih kartu untuk
                            melihat detail pelaksanaan dan deskripsi kegiatan.
                        </p>
                    </div>
                    <div class="lg:col-span-4 lg:text-right">
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center px-5 text-sm font-semibold transition-colors border min-h-11 border-ink/25 text-ink hover:border-ink hover:bg-surface active:border-ink active:bg-paper">
                            Masuk untuk mengelola
                        </a>
                    </div>
                </div>

                @if ($prokers->isNotEmpty())
                    <div x-data="{
                        selected: null,
                        showAll: false,
                        openProker(data) {
                            this.selected = data;
                            this.$refs.prokerDialog.showModal();
                        }
                    }"
                        @keydown.escape.window="if ($refs.prokerDialog?.open) $refs.prokerDialog.close()"
                        class="mt-10">
                        <ul id="proker-list" class="grid gap-5 md:grid-cols-2">
                            @foreach ($prokers as $proker)
                                @php
                                    $statusLabel = ucfirst($proker->status);
                                    $statusClass = match ($proker->status) {
                                        'selesai' => 'border-brand/20 bg-brand-tint text-brand-deep',
                                        'sedang berjalan' => 'border-brand bg-brand text-paper',
                                        'tidak berjalan' => 'border-ink/25 bg-surface text-ink',
                                        default => 'border-line bg-surface text-ink',
                                    };
                                    $dotClass = match ($proker->status) {
                                        'selesai' => 'bg-brand',
                                        'sedang berjalan' => 'bg-paper',
                                        'tidak berjalan' => 'bg-muted',
                                        default => 'bg-accent',
                                    };
                                    $divisiLabel = $proker->divisi_id ? $divisiNames[$proker->divisi_id] ?? null : null;
                                    $tanggal = $proker->tanggal_pelaksanaan
                                        ? \Carbon\Carbon::parse($proker->tanggal_pelaksanaan)->locale('id')
                                        : null;
                                    $description = trim((string) $proker->description);
                                    $hasRealDescription =
                                        $description !== '' && !str_contains(strtolower($description), 'lorem ipsum');
                                    $detail = [
                                        'name' => $proker->name_proker,
                                        'status' => $statusLabel,
                                        'statusClass' => $statusClass,
                                        'dotClass' => $dotClass,
                                        'date' => $tanggal
                                            ? $tanggal->translatedFormat('j F Y')
                                            : 'Tanggal belum ditetapkan',
                                        'divisi' => $divisiLabel ?: 'Divisi belum ditetapkan',
                                        'description' => $hasRealDescription
                                            ? $description
                                            : 'Deskripsi kegiatan belum diisi pengurus.',
                                    ];
                                @endphp

                                <li class="h-full" @if ($loop->index >= 4) x-show="showAll" x-cloak @endif>
                                    <article
                                        class="relative flex flex-col h-full p-6 transition-colors border group border-line bg-surface hover:border-brand sm:p-7">
                                        <div class="flex flex-wrap items-center justify-between gap-3">
                                            @if ($tanggal)
                                                <time datetime="{{ $proker->tanggal_pelaksanaan }}"
                                                    class="text-sm font-semibold text-muted">
                                                    {{ $tanggal->translatedFormat('j F Y') }}
                                                </time>
                                            @else
                                                <p class="text-sm text-muted">Tanggal belum ditetapkan</p>
                                            @endif
                                            <span
                                                class="inline-flex items-center gap-2 border px-3 py-1 text-xs font-semibold {{ $statusClass }}">
                                                <span aria-hidden="true"
                                                    class="h-1.5 w-1.5 rounded-full {{ $dotClass }}"></span>
                                                {{ $statusLabel }}
                                            </span>
                                        </div>

                                        <h3
                                            class="mt-6 text-2xl font-bold leading-tight transition-colors font-display group-hover:text-brand">
                                            {{ $proker->name_proker }}
                                        </h3>
                                        @if ($divisiLabel)
                                            <p class="mt-2 text-sm text-muted">Divisi: {{ $divisiLabel }}</p>
                                        @endif

                                        <div
                                            class="flex items-center justify-between gap-4 pt-4 mt-6 border-t border-line">
                                            <span aria-hidden="true"
                                                class="text-sm font-semibold underline transition-colors text-brand decoration-brand/30 underline-offset-4 group-hover:decoration-brand">
                                                Lihat detail
                                            </span>
                                            <span
                                                class="text-xs font-semibold tabular-nums text-muted">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                        </div>

                                        <button type="button" aria-haspopup="dialog" aria-controls="proker-detail"
                                            @click="openProker({{ \Illuminate\Support\Js::from($detail) }})"
                                            class="absolute inset-0 active:bg-brand-tint/40">
                                            <span class="sr-only">Lihat detail {{ $proker->name_proker }}</span>
                                        </button>
                                    </article>
                                </li>
                            @endforeach
                        </ul>

                        @if ($prokers->count() > 4)
                            <div class="mt-8 text-center">
                                <button type="button" @click="showAll = !showAll"
                                    :aria-expanded="showAll ? 'true' : 'false'" aria-controls="proker-list"
                                    class="inline-flex items-center justify-center gap-2 px-6 text-sm font-semibold transition-colors border min-h-11 border-ink/25 text-ink hover:border-ink hover:bg-surface active:border-ink active:bg-paper focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand">
                                    <span x-text="showAll ? 'Tampilkan lebih sedikit' : 'Lihat semua'">Lihat
                                        semua</span>
                                    <i class="ti" :class="showAll ? 'ti-chevron-up' : 'ti-chevron-down'"
                                        aria-hidden="true"></i>
                                </button>
                                <p class="mt-3 text-sm text-muted"
                                    x-text="showAll ? 'Menampilkan semua {{ $prokers->count() }} program kerja.' : 'Menampilkan 4 dari {{ $prokers->count() }} program kerja.'">
                                </p>
                            </div>
                        @endif

                        <dialog x-ref="prokerDialog" id="proker-detail" aria-labelledby="proker-detail-title"
                            @close="selected = null" @click.self="$refs.prokerDialog.close()"
                            class="p-0 m-auto border max-h-[85vh] w-[min(92vw,42rem)] overflow-y-auto border-line bg-surface text-ink">
                            <div class="p-6 sm:p-8">
                                <div class="flex items-start justify-between gap-6">
                                    <div>
                                        <p class="text-xs font-semibold text-muted">Detail program kerja</p>
                                        <h2 id="proker-detail-title"
                                            class="mt-2 text-2xl font-bold leading-tight font-display sm:text-3xl"
                                            x-text="selected?.name">Detail program kerja</h2>
                                    </div>
                                    <form method="dialog">
                                        <button type="submit" aria-label="Tutup detail program kerja"
                                            class="inline-flex items-center justify-center transition-colors border w-11 h-11 border-line text-ink hover:bg-paper active:bg-line/40">
                                            <i class="text-xl ti ti-x" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </div>

                                <dl class="grid gap-6 py-6 mt-8 border-t border-b border-line sm:grid-cols-3">
                                    <div>
                                        <dt class="text-xs font-semibold text-muted">Status</dt>
                                        <dd class="mt-2">
                                            <span
                                                class="inline-flex items-center gap-2 px-3 py-1 text-xs font-semibold border"
                                                :class="selected?.statusClass">
                                                <span aria-hidden="true" class="h-1.5 w-1.5 rounded-full"
                                                    :class="selected?.dotClass"></span>
                                                <span x-text="selected?.status"></span>
                                            </span>
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-semibold text-muted">Pelaksanaan</dt>
                                        <dd class="mt-2 text-sm font-semibold" x-text="selected?.date"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-semibold text-muted">Divisi</dt>
                                        <dd class="mt-2 text-sm font-semibold" x-text="selected?.divisi"></dd>
                                    </div>
                                </dl>

                                <div class="mt-6">
                                    <h3 class="text-sm font-semibold text-muted">Deskripsi</h3>
                                    <p class="mt-3 text-sm leading-relaxed text-ink" x-text="selected?.description">
                                    </p>
                                </div>

                                <div class="flex justify-end mt-8">
                                    <form method="dialog">
                                        <x-secondary-button type="submit">Tutup</x-secondary-button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                    </div>
                @else
                    <div class="px-6 py-12 mt-10 text-center border border-dashed border-line bg-surface">
                        <i class="ti {{ $dataError ? 'ti-database-off' : 'ti-calendar-off' }} text-3xl text-muted"
                            aria-hidden="true"></i>
                        <p class="mt-3 text-xl font-bold font-display">
                            {{ $dataError ? 'Data program kerja sedang tidak dapat dimuat.' : 'Belum ada program kerja tercatat.' }}
                        </p>
                        <p class="max-w-md mx-auto mt-2 text-sm leading-relaxed text-muted">
                            {{ $dataError ? 'Coba muat ulang halaman ini beberapa saat lagi.' : 'Program kerja yang ditambahkan pengurus akan muncul di bagian ini.' }}
                        </p>
                        @unless ($dataError)
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center justify-center px-6 mt-6 text-sm font-semibold transition-colors border min-h-11 border-brand bg-brand text-paper hover:border-brand-deep hover:bg-brand-deep active:border-ink active:bg-ink">
                                Masuk untuk menambahkan
                            </a>
                        @endunless
                    </div>
                @endif
            </div>
        </section>

        <section class="bg-white border-t border-line">
            <div class="max-w-6xl px-5 py-16 mx-auto lg:px-8 lg:py-20">
                <div class="relative px-6 py-12 overflow-hidden on-dark bg-ink text-paper sm:px-10 lg:px-14 lg:py-16">
                    <div aria-hidden="true" class="absolute flex gap-2 right-8 top-8">
                        <span class="w-2 h-2 rounded-full bg-accent"></span>
                        <span class="w-2 h-2 rounded-full bg-accent"></span>
                        <span class="w-2 h-2 rounded-full bg-accent"></span>
                        <span class="w-2 h-2 rounded-full bg-accent"></span>
                        <span class="w-2 h-2 rounded-full bg-accent"></span>
                    </div>

                    <div class="grid gap-8 lg:grid-cols-12 lg:items-end">
                        <div class="lg:col-span-8">
                            <h2
                                class="max-w-2xl font-display text-3xl font-extrabold leading-[1.05] tracking-tight sm:text-4xl lg:text-5xl">
                                Catat, jalankan, dan dokumentasikan kegiatan komisariat.
                            </h2>
                            <p class="max-w-xl mt-4 text-sm leading-relaxed text-paper/80 sm:text-base">
                                Masuk dengan akun yang diberikan pengurus untuk membuka dashboard SIGIKU.
                            </p>
                        </div>
                        <div class="lg:col-span-4 lg:justify-self-end">
                            @auth
                                <a href="{{ route('dashboard') }}"
                                    class="inline-flex items-center justify-center px-6 text-sm font-semibold transition-colors min-h-11 bg-paper text-ink hover:bg-surface">
                                    Buka dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="inline-flex items-center justify-center px-6 text-sm font-semibold transition-colors min-h-11 bg-paper text-ink hover:bg-surface">
                                    Masuk ke SIGIKU
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-line">
        <div
            class="flex flex-col max-w-6xl gap-6 px-5 py-10 mx-auto lg:flex-row lg:items-center lg:justify-between lg:px-8">
            <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/logos/logo-genbi.webp') }}" alt="" width="490"
                    height="489" class="object-contain w-8 h-8">
                <div class="leading-tight">
                    <p class="text-base font-extrabold tracking-tight font-display">SIGIKU</p>
                    <p class="text-xs text-muted">Sistem Informasi GenBI Universitas Kuningan</p>
                </div>
            </div>

            <nav aria-label="Navigasi footer">
                <ul class="flex flex-wrap items-center text-sm gap-x-6 gap-y-2">
                    @foreach ($navSections as $nav)
                        <li>
                            <a href="#{{ $nav['id'] }}"
                                class="inline-flex items-center font-semibold transition-colors min-h-11 text-ink hover:text-brand active:text-brand-deep">
                                {{ $nav['label'] }}
                            </a>
                        </li>
                    @endforeach
                    <li><a href="{{ route('login') }}"
                            class="inline-flex items-center font-semibold min-h-11 text-brand active:text-brand-deep">Masuk</a>
                    </li>
                </ul>
            </nav>

            <p class="text-xs text-muted">© {{ date('Y') }} SIGIKU · GenBI Universitas Kuningan</p>
        </div>
    </footer>
</body>

</html>

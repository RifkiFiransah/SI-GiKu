@props(['title' => 'SIGIKU · Sistem Informasi GenBI Universitas Kuningan'])

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#F5F1E8">

    <title>{{ $title }}</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logos/logo-genbi.webp') }}">
    <link rel="preload" href="{{ asset('assets/fonts/bricolage-grotesque-700.woff2') }}" as="font"
        type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('assets/fonts/plus-jakarta-sans-400.woff2') }}" as="font" type="font/woff2"
        crossorigin>
    <link rel="stylesheet" href="{{ asset('assets/css/icons/tabler-icons/tabler-icons.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen antialiased bg-paper font-body text-ink">
    <div class="min-h-screen lg:grid lg:grid-cols-2">
        <aside
            class="relative hidden px-10 py-12 overflow-hidden on-dark bg-brand text-paper lg:flex lg:flex-col xl:px-14">
            <img src="{{ asset('assets/images/logos/logo-genbi.webp') }}" alt="" width="490" height="489"
                aria-hidden="true" class="absolute pointer-events-none -bottom-12 -right-12 w-80 opacity-10">

            <a href="{{ url('/') }}" class="relative z-10 flex items-center gap-3">
                <span class="flex items-center justify-center w-10 h-10 p-1 bg-paper">
                    <img src="{{ asset('assets/images/logos/logo-genbi.webp') }}" alt="" width="490"
                        height="489" class="object-contain w-full h-full">
                </span>
                <span class="leading-none">
                    <span class="block text-lg font-extrabold tracking-tight font-display">SIGIKU</span>
                    <span class="block mt-1 text-xs font-medium text-paper/90">Sistem Informasi GenBI UNIKU</span>
                </span>
            </a>

            <div class="relative z-10 max-w-md mt-16">
                <p class="flex items-center gap-3 text-sm font-semibold text-paper/90">
                    <span aria-hidden="true" class="w-2 h-2 bg-paper"></span>
                    GenBI Universitas Kuningan
                </p>
                <p class="mt-5 font-display text-4xl font-extrabold leading-[1.02] tracking-tight xl:text-5xl">
                    Ruang kerja komisariat dalam satu sistem.
                </p>
                <p class="mt-5 text-sm leading-relaxed text-paper/90 xl:text-base">
                    Data anggota, divisi, program kerja, dan absensi kegiatan tersimpan rapi di SIGIKU.
                </p>
                <div aria-hidden="true" class="flex gap-2 mt-8">
                    <span class="w-2 h-2 rounded-full bg-paper/80"></span>
                    <span class="w-2 h-2 rounded-full bg-paper/80"></span>
                    <span class="w-2 h-2 rounded-full bg-paper/80"></span>
                    <span class="w-2 h-2 rounded-full bg-paper/80"></span>
                    <span class="w-2 h-2 rounded-full bg-paper/80"></span>
                </div>
            </div>

            <div class="relative z-10 pt-6 mt-auto border-t border-paper/25">
                <div class="flex items-center gap-4">
                    <span class="flex h-14 w-14 items-center justify-center bg-paper p-1.5">
                        <img src="{{ asset('assets/images/logos/uniku.webp') }}" alt="Lambang Universitas Kuningan"
                            width="300" height="296" class="object-contain w-full h-full">
                    </span>
                    <div>
                        <p class="text-sm font-semibold">Komisariat Universitas Kuningan</p>
                        <p class="text-xs text-paper/90">Koordinator Komisariat Cirebon</p>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex flex-col min-h-screen">
            <header class="flex items-center justify-between gap-4 px-5 py-4 border-b border-line sm:px-8 lg:hidden">
                <a href="{{ url('/') }}" class="flex items-center gap-3 min-h-11">
                    <img src="{{ asset('assets/images/logos/logo-genbi.webp') }}" alt="" width="490"
                        height="489" class="object-contain h-9 w-9">
                    <span class="leading-none">
                        <span class="block text-base font-extrabold tracking-tight font-display">SIGIKU</span>
                        <span class="block mt-1 text-xs text-muted">GenBI UNIKU</span>
                    </span>
                </a>
                <a href="{{ url('/') }}"
                    class="inline-flex items-center text-sm font-semibold underline min-h-11 text-brand decoration-brand/30 underline-offset-4">Beranda</a>
            </header>

            <div class="flex items-center justify-center flex-1 px-5 py-12 sm:px-8">
                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>
            </div>

            <footer class="px-5 py-5 border-t border-line sm:px-8">
                <div class="max-w-md mx-auto">
                    <p class="text-xs text-muted">© {{ date('Y') }} SIGIKU · GenBI Universitas Kuningan</p>
                </div>
            </footer>
        </main>
    </div>
</body>

</html>

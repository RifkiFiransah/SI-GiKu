<x-guest-layout title="Lupa kata sandi · SIGIKU">
    <div>
        <p class="flex items-center gap-3 text-sm font-semibold text-brand">
            <span aria-hidden="true" class="h-2 w-2 bg-accent"></span>
            Pemulihan akun
        </p>
        <h1 class="mt-4 font-display text-3xl font-extrabold leading-tight tracking-tight sm:text-4xl">
            Lupa kata sandi?
        </h1>
        <p class="mt-3 text-sm leading-relaxed text-muted">
            Masukkan email akun. Kami akan mengirim tautan untuk membuat kata sandi baru.
        </p>
    </div>

    <x-auth-session-status class="mt-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" :value="old('email')" required autofocus autocomplete="username" class="mt-2" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">
            Kirim tautan reset
        </x-primary-button>
    </form>

    <p class="mt-8 border-t border-line pt-6 text-sm text-muted">
        Ingat kata sandimu?
        <a href="{{ route('login') }}" class="font-semibold text-brand underline decoration-brand/30 underline-offset-4 transition-colors hover:decoration-brand active:text-brand-deep active:decoration-brand-deep">Kembali ke halaman masuk</a>
    </p>
</x-guest-layout>

<x-guest-layout title="Daftar · SIGIKU">
    <div>
        <p class="flex items-center gap-3 text-sm font-semibold text-brand">
            <span aria-hidden="true" class="h-2 w-2 bg-accent"></span>
            Akun baru
        </p>
        <h1 class="mt-4 font-display text-3xl font-extrabold leading-tight tracking-tight sm:text-4xl">
            Buat akun SIGIKU
        </h1>
        <p class="mt-3 text-sm leading-relaxed text-muted">
            Isi data berikut untuk mendaftarkan akun dan mengakses dashboard komisariat.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <x-input-label for="name" value="Nama lengkap" />
            <x-text-input id="name" name="name" type="text" :value="old('name')" required autofocus autocomplete="name" class="mt-2" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" :value="old('email')" required autocomplete="username" class="mt-2" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Kata sandi" />
            <x-text-input id="password" name="password" type="password" required autocomplete="new-password" aria-describedby="password-help" class="mt-2" />
            <p id="password-help" class="mt-2 text-xs text-muted">Minimal 8 karakter.</p>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi kata sandi" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="mt-2" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">
            Daftar
        </x-primary-button>
    </form>

    <p class="mt-8 border-t border-line pt-6 text-sm text-muted">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="font-semibold text-brand underline decoration-brand/30 underline-offset-4 transition-colors hover:decoration-brand active:text-brand-deep active:decoration-brand-deep">Masuk di sini</a>
    </p>
</x-guest-layout>

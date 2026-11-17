<x-guest-layout title="Masuk · SIGIKU">
    <div>
        <p class="flex items-center gap-3 text-sm font-semibold text-brand">
            <span aria-hidden="true" class="h-2 w-2 bg-accent"></span>
            Akun pengurus dan anggota
        </p>
        <h1 class="mt-4 font-display text-3xl font-extrabold leading-tight tracking-tight sm:text-4xl">
            Masuk ke SIGIKU
        </h1>
        <p class="mt-3 text-sm leading-relaxed text-muted">
            Gunakan email dan kata sandi akun komisariat untuk membuka dashboard.
        </p>
    </div>

    <x-auth-session-status class="mt-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" :value="old('email')" required autofocus autocomplete="username" class="mt-2" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
                <x-input-label for="password" value="Kata sandi" />
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-semibold text-brand underline decoration-brand/30 underline-offset-4 transition-colors hover:decoration-brand active:text-brand-deep active:decoration-brand-deep">
                        Lupa kata sandi?
                    </a>
                @endif
            </div>
            <x-text-input id="password" name="password" type="password" required autocomplete="current-password" class="mt-2" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="flex min-h-11 items-center gap-3 text-sm text-ink">
            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 border-muted/70 text-brand focus:ring-brand/30">
            <span>Ingat saya di perangkat ini</span>
        </label>

        <x-primary-button class="w-full">
            Masuk
        </x-primary-button>
    </form>

    <p class="mt-8 border-t border-line pt-6 text-sm text-muted">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-semibold text-brand underline decoration-brand/30 underline-offset-4 transition-colors hover:decoration-brand active:text-brand-deep active:decoration-brand-deep">Daftar akun</a>
    </p>
</x-guest-layout>

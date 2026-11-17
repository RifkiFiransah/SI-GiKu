<x-guest-layout title="Atur ulang kata sandi · SIGIKU">
    <div>
        <p class="flex items-center gap-3 text-sm font-semibold text-brand">
            <span aria-hidden="true" class="h-2 w-2 bg-accent"></span>
            Pemulihan akun
        </p>
        <h1 class="mt-4 font-display text-3xl font-extrabold leading-tight tracking-tight sm:text-4xl">
            Atur ulang kata sandi
        </h1>
        <p class="mt-3 text-sm leading-relaxed text-muted">
            Buat kata sandi baru untuk akunmu, lalu masuk kembali.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="mt-8 space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" :value="old('email', $request->email)" required autofocus autocomplete="username" class="mt-2" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Kata sandi baru" />
            <x-text-input id="password" name="password" type="password" required autocomplete="new-password" aria-describedby="password-help" class="mt-2" />
            <p id="password-help" class="mt-2 text-xs text-muted">Minimal 8 karakter.</p>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi kata sandi baru" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="mt-2" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">
            Simpan kata sandi
        </x-primary-button>
    </form>
</x-guest-layout>

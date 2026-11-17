<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex min-h-11 items-center justify-center border border-brand bg-brand px-5 text-sm font-semibold text-paper transition-colors hover:border-brand-deep hover:bg-brand-deep active:border-ink active:bg-ink disabled:cursor-not-allowed disabled:opacity-60']) }}>
    {{ $slot }}
</button>

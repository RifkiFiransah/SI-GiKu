<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex min-h-11 items-center justify-center border border-ink/25 bg-transparent px-5 text-sm font-semibold text-ink transition-colors hover:border-ink hover:bg-surface active:border-ink active:bg-paper disabled:cursor-not-allowed disabled:opacity-60']) }}>
    {{ $slot }}
</button>

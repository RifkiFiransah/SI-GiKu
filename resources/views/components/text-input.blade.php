@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full border border-muted/70 bg-surface px-4 py-3 text-sm text-ink transition-colors placeholder:text-muted hover:border-muted focus:border-brand disabled:bg-paper disabled:text-muted']) !!}>

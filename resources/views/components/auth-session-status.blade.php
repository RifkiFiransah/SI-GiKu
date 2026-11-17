@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'border border-brand/20 bg-brand-tint px-4 py-3 text-sm font-medium text-brand-deep']) }}>
        {{ $status }}
    </div>
@endif

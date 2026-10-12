@props(['title', 'lead' => null])

<div {{ $attributes->merge(['class' => 'mb-6']) }}>
    <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
        <h2 class="text-2xl font-semibold text-ink">{{ $title }}</h2>
        {{ $aside ?? '' }}
    </div>
    @if ($lead)
        <p class="mt-1 text-sm text-muted">{{ $lead }}</p>
    @endif
</div>

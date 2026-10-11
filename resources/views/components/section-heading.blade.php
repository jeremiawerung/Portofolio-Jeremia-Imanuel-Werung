@props(['icon' => null, 'title', 'lead' => null])

<div {{ $attributes->merge(['class' => 'mb-5']) }}>
    <h2 class="flex items-center gap-2 text-lg font-semibold text-slate-100">
        @if ($icon)
            <i data-lucide="{{ $icon }}" class="w-5 h-5 text-indigo-400"></i>
        @endif
        {{ $title }}
    </h2>
    @if ($lead || isset($aside))
        <div class="mt-1 flex flex-wrap items-center justify-between gap-2">
            @if ($lead)
                <p class="text-sm text-slate-400">{{ $lead }}</p>
            @endif
            {{ $aside ?? '' }}
        </div>
    @endif
</div>

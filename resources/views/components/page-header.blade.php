@props(['title', 'lead' => null])

<header class="reveal visible">
    <h1 class="page-title">{{ $title }}</h1>
    @if ($lead)
        <p class="page-lead">{{ $lead }}</p>
    @endif
    {{ $slot }}
</header>
<hr class="page-divider">

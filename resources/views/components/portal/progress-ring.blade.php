@props([
    'value' => 0,
    'size' => 88,
    'stroke' => 6,
    'track' => 'var(--color-hair)',
    'color' => 'var(--color-gold)',
])

@php
    $radius = ($size - $stroke) / 2;
    $circumference = 2 * M_PI * $radius;
    $offset = $circumference * (1 - $value);
    $centre = $size / 2;
@endphp

<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 {{ $size }} {{ $size }}"
     {{ $attributes->merge(['class' => 'flex-none']) }} aria-hidden="true">
    <circle cx="{{ $centre }}" cy="{{ $centre }}" r="{{ $radius }}"
            stroke="{{ $track }}" stroke-width="{{ $stroke }}" fill="none"/>
    <circle cx="{{ $centre }}" cy="{{ $centre }}" r="{{ $radius }}"
            stroke="{{ $color }}" stroke-width="{{ $stroke }}" fill="none"
            stroke-dasharray="{{ $circumference }}" stroke-dashoffset="{{ $offset }}"
            stroke-linecap="round"
            transform="rotate(-90 {{ $centre }} {{ $centre }})"/>
</svg>

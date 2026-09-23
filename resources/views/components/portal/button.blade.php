@props([
    'variant' => 'soft',
    'size' => null,
    'href' => null,
    'arrow' => false,
])

@php
    $base = 'group inline-flex items-center gap-2.5 whitespace-nowrap rounded-full border border-transparent font-semibold leading-none transition-all hover:-translate-y-px disabled:translate-y-0 disabled:cursor-not-allowed disabled:opacity-50';

    $variants = [
        'primary' => 'bg-black text-white',
        'ghost' => 'border-ink bg-transparent text-ink hover:bg-ink hover:text-white',
        'soft' => 'border-hair bg-paper text-ink hover:border-ink',
        'invert' => 'bg-white text-black',
        'gold' => 'bg-gold text-white',
    ];

    $sizes = [
        null => 'px-[18px] py-3 text-[13.5px]',
        'lg' => 'px-6 py-4 text-sm',
        'block' => 'w-full justify-center px-[22px] py-4 text-sm',
    ];

    $classes = $base.' '.($variants[$variant] ?? $variants['soft']).' '.($sizes[$size] ?? $sizes[null]);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
        @if ($arrow)
            <span class="arrow-mask h-2.5 w-3.5 bg-current transition-transform group-hover:translate-x-0.5"></span>
        @endif
    </a>
@else
    <button {{ $attributes->merge(['type' => 'button', 'class' => $classes]) }}>
        {{ $slot }}
        @if ($arrow)
            <span class="arrow-mask h-2.5 w-3.5 bg-current transition-transform group-hover:translate-x-0.5"></span>
        @endif
    </button>
@endif

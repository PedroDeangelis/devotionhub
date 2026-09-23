@props(['name', 'size' => 18])

@php
    $paths = [
        'home' => '<path d="M3 11l9-7 9 7"/><path d="M5 10v10h14V10"/>',
        'book' => '<path d="M4 4h12a4 4 0 014 4v12"/><path d="M4 4v16h12a4 4 0 014-4"/>',
        'map' => '<path d="M9 4l-6 2v14l6-2 6 2 6-2V4l-6 2-6-2z"/><path d="M9 4v16M15 6v16"/>',
        'leaf' => '<path d="M20 4C10 4 4 10 4 20"/><path d="M20 4c0 10-6 16-16 16"/>',
        'prayer' => '<path d="M12 3v18M7 12c0-4 2-7 5-9M17 12c0-4-2-7-5-9"/>',
        'chart' => '<path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>',
        'stack' => '<path d="M3 6h18M3 12h18M3 18h18"/>',
        'gear' => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 00.3 1.8l.1.1a2 2 0 11-2.8 2.8l-.1-.1a1.7 1.7 0 00-1.8-.3 1.7 1.7 0 00-1 1.5V21a2 2 0 11-4 0v-.1a1.7 1.7 0 00-1.1-1.5 1.7 1.7 0 00-1.8.3l-.1.1a2 2 0 11-2.8-2.8l.1-.1a1.7 1.7 0 00.3-1.8 1.7 1.7 0 00-1.5-1H3a2 2 0 110-4h.1a1.7 1.7 0 001.5-1.1 1.7 1.7 0 00-.3-1.8l-.1-.1a2 2 0 112.8-2.8l.1.1a1.7 1.7 0 001.8.3H9a1.7 1.7 0 001-1.5V3a2 2 0 114 0v.1a1.7 1.7 0 001 1.5 1.7 1.7 0 001.8-.3l.1-.1a2 2 0 112.8 2.8l-.1.1a1.7 1.7 0 00-.3 1.8V9a1.7 1.7 0 001.5 1H21a2 2 0 110 4h-.1a1.7 1.7 0 00-1.5 1z"/>',
        'award' => '<circle cx="12" cy="9" r="6"/><path d="M8.5 14l-2 7 5.5-3 5.5 3-2-7"/>',
        'search' => '<circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4"/>',
        'bell' => '<path d="M6 8a6 6 0 1112 0c0 7 3 9 3 9H3s3-2 3-9z"/><path d="M10 21a2 2 0 004 0"/>',
        'caret' => '<path d="M6 9l6 6 6-6"/>',
        'logout' => '<path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/><path d="M10 17l-5-5 5-5"/><path d="M15 12H5"/>',
        'plus' => '<path d="M12 5v14M5 12h14"/>',
        'lock' => '<rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 018 0v4"/>',
        'doc' => '<path d="M14 3H6a2 2 0 00-2 2v14a2 2 0 002 2h12a2 2 0 002-2V9z"/><path d="M14 3v6h6M9 14h6M9 17h4"/>',
        'compass' => '<circle cx="12" cy="12" r="9"/><path d="M16 8l-2 6-6 2 2-6 6-2z"/>',
        'flame' => '<path d="M12 3c2 4 6 5 6 10a6 6 0 11-12 0c0-3 2-4 3-7 1 1.5 2 3 3 4 0-2 0-4 0-7z"/>',
        'wave' => '<path d="M3 12c2-3 4-3 6 0s4 3 6 0 4-3 6 0"/>',
        'download' => '<path d="M12 4v12M6 12l6 6 6-6M4 20h16"/>',
        'share' => '<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="M8.5 13.5l7 4M15.5 6.5l-7 4"/>',
        'arrow-right' => '<path d="M5 12h14M13 5l7 7-7 7"/>',
        'heart' => '<path d="M12 21s-7-4.5-9.5-9C.5 8 4 4 7.5 4c1.7 0 3.2.8 4.5 2.4C13.3 4.8 14.8 4 16.5 4 20 4 23.5 8 21.5 12c-2.5 4.5-9.5 9-9.5 9z"/>',
    ];

    /* Filled icons take no stroke. */
    $filled = [
        'play' => '<path d="M8 5v14l11-7z"/>',
        'star' => '<path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7l3-7z"/>',
    ];
@endphp

@if ($name === 'check')
    <svg {{ $attributes->merge(['class' => 'inline-block flex-none']) }} width="{{ $size }}" height="{{ $size }}"
         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
         stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l4 4 10-10"/></svg>
@elseif (isset($filled[$name]))
    <svg {{ $attributes->merge(['class' => 'inline-block flex-none']) }} width="{{ $size }}" height="{{ $size }}"
         viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">{!! $filled[$name] !!}</svg>
@elseif (isset($paths[$name]))
    <svg {{ $attributes->merge(['class' => 'inline-block flex-none']) }} width="{{ $size }}" height="{{ $size }}"
         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
         stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $paths[$name] !!}</svg>
@endif

@props([
    'mode' => 'view',
    'value' => '',
    'model' => null,
    'as' => 'text',
    'placeholder' => '',
    'tag' => 'div',
])

{{--
    One editable value.

    The same $attributes - and so the same typography - are applied in both
    modes, which is what makes the admin canvas a real preview rather than an
    approximation: the admin types the heading into display-sized type.

    Newlines in a stored value render as line breaks, standing in for the <br>
    tags the original hardcoded markup used.
--}}

@php
    /*
     * A single-line input silently eats newlines, so any value that has one is
     * edited in a textarea regardless of the declared type. Headings in this
     * design routinely wrap deliberately.
     */
    $multiline = $as === 'textarea' || str_contains((string) $value, "\n");
@endphp

@if ($mode === 'edit' && $model)
    @if ($multiline)
        <textarea wire:model.live.debounce.600ms="{{ $model }}"
                  rows="{{ max(2, substr_count((string) $value, "\n") + 2) }}"
                  placeholder="{{ $placeholder }}"
                  {{ $attributes->class(['block w-full resize-y rounded-lg border border-dashed border-hair-soft bg-paper/60 px-3 py-2 outline-none transition-colors focus:border-gold focus:bg-paper']) }}>{{ $value }}</textarea>
    @else
        <input type="text"
               wire:model.live.debounce.600ms="{{ $model }}"
               placeholder="{{ $placeholder }}"
               {{ $attributes->class(['block w-full rounded-lg border border-dashed border-hair-soft bg-paper/60 px-3 py-2 outline-none transition-colors focus:border-gold focus:bg-paper']) }}>
    @endif
@else
    <{{ $tag }} {{ $attributes }}>{!! nl2br(e($value)) !!}</{{ $tag }}>
@endif

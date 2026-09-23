@props(['number' => null, 'label'])

<div class="flex items-center gap-3 font-mono text-[10.5px] font-medium uppercase tracking-[0.22em] text-ink-3">
    @if ($number)
        <span class="inline-flex size-6 items-center justify-center rounded-md bg-ink font-semibold text-white">{{ $number }}</span>
    @endif
    {{ $label }}
</div>

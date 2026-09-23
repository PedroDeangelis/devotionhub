@props(['dot' => 'bg-gold'])

<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 font-mono text-[10.5px] font-medium uppercase tracking-[0.22em] text-ink-3']) }}>
    <span class="size-1.5 flex-none rounded-full {{ $dot }}"></span>
    {{ $slot }}
</div>

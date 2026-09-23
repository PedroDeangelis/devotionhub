@php
    $isActive = $current === $item['route'];
@endphp

<a href="{{ route($item['route']) }}" wire:navigate
   @class([
       'group relative flex items-center gap-3 whitespace-nowrap rounded-[10px] px-3 py-2.5 text-[13.5px] transition-colors',
       'bg-bg-deep font-semibold text-ink' => $isActive,
       'font-medium text-ink-2 hover:bg-ink/5 hover:text-ink' => ! $isActive,
   ])>
    @if ($isActive)
        <span class="absolute left-1 top-1/2 h-[18px] w-[3px] -translate-y-1/2 rounded-sm bg-gold"></span>
    @endif

    <x-portal.icon :name="$item['icon']" :size="17" @class(['text-gold' => $isActive, 'text-ink-3' => ! $isActive]) />
    <span class="min-w-0 overflow-hidden text-ellipsis">{{ $item['label'] }}</span>

    @isset($item['pill'])
        <span @class([
            'ml-auto flex-none rounded-full px-[7px] py-0.5 font-mono text-[9.5px] font-semibold leading-[1.4] tracking-[0.08em]',
            $item['pillClass'] ?? ($isActive ? 'bg-gold text-white' : 'bg-gold-light text-gold'),
        ])>{{ $item['pill'] }}</span>
    @endisset
</a>

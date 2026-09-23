@props(['eyebrow' => null, 'title', 'sub' => null])

<div class="mb-9 flex flex-col items-start justify-between gap-6 lg:flex-row lg:items-end lg:gap-10">
    <div class="max-w-[720px]">
        @if ($eyebrow)
            <x-portal.eyebrow class="mb-[18px]">{{ $eyebrow }}</x-portal.eyebrow>
        @endif

        <h1 class="mb-3.5 font-display text-[clamp(42px,5.4vw,72px)] font-bold leading-[0.95] tracking-[-0.035em]">
            {!! $title !!}
        </h1>

        @if ($sub)
            <p class="max-w-[60ch] text-[17px] leading-[1.5] text-ink-3">{!! $sub !!}</p>
        @endif
    </div>

    @isset($actions)
        <div class="flex flex-wrap items-center gap-2.5">{{ $actions }}</div>
    @endisset
</div>

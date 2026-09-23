@php
    $portal = config('portal');
    $today = $portal['today_day'];
    $total = $portal['total_days'];
    $pct = (int) round($today / $total * 100);
@endphp

<div>
    <x-portal.page-head
        eyebrow="Today's Journey"
        title="Welcome back,<br>Grace."
        :sub="'You\'re on <b class=\'font-semibold text-ink\'>Day '.$today.'</b> of your 90-day journey through Scripture. Today\'s lesson is ready when you are.'">
        <x-slot:actions>
            <x-portal.button variant="soft" :href="route('portal.journey')" wire:navigate>View journey</x-portal.button>
            <x-portal.button variant="primary" :href="route('portal.lesson')" wire:navigate arrow>Continue lesson</x-portal.button>
        </x-slot:actions>
    </x-portal.page-head>

    <div class="grid grid-cols-1 gap-4 xl:grid-cols-[1.15fr_1fr]">
        {{-- Hero card --}}
        <div class="relative flex min-h-[460px] flex-col justify-between overflow-hidden rounded-[26px] bg-black p-8 text-white lg:px-10 lg:pb-9 lg:pt-10">
            <div class="absolute right-7 top-7">
                <span class="inline-flex items-center gap-2 font-mono text-[10.5px] uppercase tracking-[0.18em] text-gold">
                    <span class="pulse-dot size-1.5 rounded-full bg-gold"></span>
                    Live &middot; Day {{ $today }}
                </span>
            </div>

            <div class="flex items-baseline gap-3">
                <span class="font-display text-[56px] font-extrabold leading-[0.9] tracking-[-0.04em] text-white">
                    Day <em class="not-italic text-gold">{{ $today }}</em>
                </span>
                <span class="font-mono text-[11px] uppercase leading-[1.5] tracking-[0.18em] text-white/55">
                    Of ninety<br>Movement 03 &middot; Abraham
                </span>
            </div>

            <div class="mb-4 mt-10 font-display text-[36px] font-bold leading-[1.02] tracking-[-0.025em] text-white">
                Abraham's ultimate test of faith.
            </div>

            <div class="flex flex-wrap items-center gap-2 font-mono text-[11px] uppercase tracking-[0.14em] text-white/55">
                <span>Genesis 22</span><span class="text-gold">&middot;</span>
                <span>12 min lesson</span><span class="text-gold">&middot;</span>
                <span>Reflection included</span>
            </div>

            <p class="mb-7 mt-5 max-w-[46ch] text-sm leading-[1.6] text-white/65">
                Today you'll see how trust, surrender, and God's provision come together in one of
                Scripture's most powerful moments — the climb up Mount Moriah and the ram caught in
                the thicket.
            </p>

            <div class="mb-7 flex items-center gap-3.5">
                <div class="h-[3px] flex-1 overflow-hidden rounded-sm bg-white/10">
                    <div class="h-full bg-gold" style="width: {{ $pct }}%"></div>
                </div>
                <div class="font-mono text-[11px] font-medium tracking-[0.06em] text-white/55">
                    <em class="not-italic text-gold">{{ $pct }}%</em>
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <x-portal.button variant="invert" size="lg" :href="route('portal.lesson')" wire:navigate arrow>Continue lesson</x-portal.button>
                <x-portal.button size="lg" class="border-white/25 bg-transparent text-white hover:border-white hover:bg-white hover:text-black">Preview Day 13</x-portal.button>
            </div>
        </div>

        {{-- Right column --}}
        <div class="flex flex-col gap-4">
            <div class="grid grid-cols-2 gap-4">
                @foreach ([
                    ['Lessons', $today - 1, ' / 90', 'Completed so far', false],
                    ['Current streak', $portal['streak'], ' days', 'Longest yet — 14 days', true],
                    ['Reflections', $portal['reflections_count'], null, 'Written in your journal', false],
                    ['Complete', $pct, '%', 'Of the 90-day path', true],
                ] as [$label, $value, $small, $desc, $gold])
                    <div @class([
                        'flex min-h-[130px] flex-col rounded-[20px] border px-[22px] pb-5 pt-[22px]',
                        'border-transparent bg-gold-light' => $gold,
                        'border-hair bg-paper' => ! $gold,
                    ])>
                        <div class="font-mono text-[10px] font-medium uppercase tracking-[0.2em] text-muted">{{ $label }}</div>
                        <div class="mt-auto font-display text-[48px] font-extrabold leading-[0.9] tracking-[-0.04em] text-ink">
                            <em @class(['not-italic', 'text-gold' => $gold])>{{ $value }}</em><span class="text-[22px] font-semibold tracking-[-0.02em] text-ink-3">{{ $small }}</span>
                        </div>
                        <div class="mt-1.5 text-[12.5px] leading-[1.4] text-ink-3">{{ $desc }}</div>
                    </div>
                @endforeach
            </div>

            <div class="rounded-[20px] border border-hair bg-paper p-7">
                <x-portal.eyebrow>Today's reflection</x-portal.eyebrow>
                <div class="my-4 font-display text-[22px] font-bold leading-[1.15] tracking-[-0.022em] text-ink">
                    Where is God inviting you to trust Him more deeply?
                </div>
                <x-portal.button variant="primary" :href="route('portal.reflections')" wire:navigate arrow>Write reflection</x-portal.button>
            </div>

            <div class="rounded-[20px] border border-hair bg-bg-deep p-6">
                <x-portal.eyebrow dot="bg-olive">Verse for today</x-portal.eyebrow>
                <div class="mt-4 font-display text-[22px] font-semibold leading-[1.2] tracking-[-0.022em] text-ink">
                    The Lord is my strength and my song.
                </div>
                <div class="mt-2 font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">Exodus 15:2 &middot; KJV</div>
                <div class="mt-5">
                    <x-portal.button variant="soft">
                        <x-portal.icon name="heart" :size="14" /> Save to reflections
                    </x-portal.button>
                </div>
            </div>
        </div>
    </div>

    {{-- Mini journey --}}
    <div class="mt-4 rounded-[20px] border border-hair bg-paper p-6 lg:p-8">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <x-portal.eyebrow>Your journey</x-portal.eyebrow>
                <h3 class="mt-2.5 font-display text-[26px] font-bold leading-none tracking-[-0.025em]">From Genesis to Jesus.</h3>
            </div>
            <x-portal.button variant="soft" :href="route('portal.journey')" wire:navigate arrow>Open journey map</x-portal.button>
        </div>

        <div class="mt-7 grid grid-cols-2 gap-4 sm:grid-cols-4 lg:grid-cols-7">
            @foreach ($portal['sections'] as $section)
                <a href="{{ route('portal.journey') }}" wire:navigate class="group flex flex-col gap-2">
                    <span @class([
                        'size-3 rounded-full border-[1.5px] transition-colors',
                        'border-olive bg-olive' => $section['state'] === 'completed',
                        'border-gold bg-gold shadow-[0_0_0_4px_rgb(184_135_60/0.18)]' => $section['state'] === 'current',
                        'border-hair-soft bg-transparent' => $section['state'] === 'locked',
                    ])></span>
                    <span @class([
                        'font-display text-[15px] font-bold leading-none tracking-[-0.02em] transition-colors group-hover:text-gold',
                        'text-ink' => $section['state'] !== 'locked',
                        'text-muted' => $section['state'] === 'locked',
                    ])>{{ $section['name'] }}</span>
                    <span class="font-mono text-[10px] uppercase tracking-[0.14em] text-muted">Day {{ $section['days'][0] }}&ndash;{{ $section['days'][1] }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>

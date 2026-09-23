@php
    $portal = config('portal');
@endphp

<div>
    <x-portal.page-head
        eyebrow="Your Journey"
        title="From Genesis<br>to Jesus."
        sub="Follow the story of Scripture through creation, covenant, kingdom, exile, promise, Christ, and resurrection. Seven movements. Ninety days. One unfolding story.">
        <x-slot:actions>
            <x-portal.button variant="primary" :href="route('portal.lesson')" wire:navigate arrow>Continue today's lesson</x-portal.button>
        </x-slot:actions>
    </x-portal.page-head>

    {{-- Movement cards --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($portal['sections'] as $section)
            <div @class([
                'flex min-h-[220px] flex-col gap-3.5 rounded-[20px] border p-[22px] transition-all',
                'border-gold bg-paper shadow-card' => $section['state'] === 'current',
                'border-hair bg-paper' => $section['state'] === 'completed',
                'border-hair bg-paper/50 opacity-70' => $section['state'] === 'locked',
            ])>
                <div>
                    <div class="font-mono text-[10px] font-medium uppercase tracking-[0.2em] text-muted">Movement {{ $section['ord'] }}</div>
                    <div class="mt-1.5 font-display text-2xl font-bold leading-none tracking-[-0.025em] text-ink">{{ $section['name'] }}</div>
                    <div class="mt-1 font-mono text-[10.5px] uppercase tracking-[0.14em] text-ink-3">Day {{ $section['days'][0] }}&ndash;{{ $section['days'][1] }}</div>
                </div>

                <div class="text-[13.5px] leading-[1.5] text-ink-3">{{ $section['desc'] }}</div>

                <div class="mt-auto">
                    <div class="h-1 overflow-hidden rounded-sm bg-bg-deep">
                        <div @class(['h-full', 'bg-olive' => $section['state'] === 'completed', 'bg-gold' => $section['state'] !== 'completed'])
                             style="width: {{ $section['total'] ? $section['done'] / $section['total'] * 100 : 0 }}%"></div>
                    </div>
                    <div class="mt-2.5 flex items-center gap-2 font-mono text-[10px] font-medium uppercase tracking-[0.16em] text-muted">
                        @if ($section['state'] === 'locked')
                            <x-portal.icon name="lock" :size="11" /> Locked — opens day {{ $section['days'][0] }}
                        @else
                            {{ $section['done'] }} of {{ $section['total'] }} completed
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Current movement lessons --}}
    <div class="mt-6 rounded-[20px] border border-hair bg-paper p-6 lg:p-8">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-4 border-b border-hair pb-5">
            <div>
                <div class="font-display text-[22px] font-bold leading-none tracking-[-0.025em]">Abraham — Promise and Faith</div>
                <div class="mt-2 font-mono text-[10.5px] uppercase tracking-[0.16em] text-ink-3">Movement 02 &middot; Day 9 – 18 &middot; 10 lessons</div>
            </div>
            <div class="font-mono text-[11px] font-semibold uppercase tracking-[0.16em] text-gold">4 of 10 completed</div>
        </div>

        @foreach ($portal['abraham_lessons'] as $lesson)
            <div @class([
                'grid grid-cols-[44px_1fr] items-center gap-4 border-b border-hair py-4 last:border-0 md:grid-cols-[44px_1fr_auto_auto_auto] md:gap-6',
                'opacity-55' => $lesson['state'] === 'locked',
            ])>
                <div @class([
                    'font-display text-xl font-extrabold tracking-[-0.03em]',
                    'text-gold' => $lesson['state'] === 'current',
                    'text-ink' => $lesson['state'] === 'completed',
                    'text-muted' => in_array($lesson['state'], ['locked', 'upcoming'], true),
                ])>{{ str_pad((string) $lesson['day'], 2, '0', STR_PAD_LEFT) }}</div>

                <div class="min-w-0">
                    <div class="truncate font-display text-[17px] font-bold leading-tight tracking-[-0.02em] text-ink">{{ $lesson['title'] }}</div>
                    <div class="mt-1 font-mono text-[10.5px] uppercase tracking-[0.14em] text-muted">{{ $lesson['scrip'] }}</div>
                </div>

                <div class="col-span-2 flex items-center gap-2 font-mono text-[10.5px] font-medium uppercase tracking-[0.14em] md:col-span-1">
                    @if ($lesson['state'] === 'completed')
                        <span class="inline-flex size-4 items-center justify-center rounded-full bg-olive text-white"><x-portal.icon name="check" :size="9" /></span>
                        <span class="text-ink-3">Completed</span>
                    @elseif ($lesson['state'] === 'current')
                        <span class="text-gold">Current</span>
                    @elseif ($lesson['state'] === 'upcoming')
                        <span class="text-ink-3">Tomorrow</span>
                    @else
                        <x-portal.icon name="lock" :size="12" class="text-muted" /><span class="text-muted">Locked</span>
                    @endif
                </div>

                <div class="hidden font-mono text-[10.5px] uppercase tracking-[0.14em] text-muted md:block">12 min</div>

                <div class="col-span-2 md:col-span-1">
                    @if ($lesson['state'] === 'current')
                        <x-portal.button variant="primary" :href="route('portal.lesson')" wire:navigate arrow>Open</x-portal.button>
                    @elseif ($lesson['state'] === 'completed')
                        <x-portal.button variant="soft" :href="route('portal.lesson')" wire:navigate>Review</x-portal.button>
                    @elseif ($lesson['state'] === 'upcoming')
                        <x-portal.button variant="soft">Preview</x-portal.button>
                    @else
                        <x-portal.button variant="soft" disabled>Locked</x-portal.button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- Completed movement --}}
    <div class="mt-4 rounded-[20px] border border-hair bg-paper p-6 lg:p-8">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-4 border-b border-hair pb-5">
            <div>
                <div class="font-display text-[22px] font-bold leading-none tracking-[-0.025em]">Creation — In the Beginning</div>
                <div class="mt-2 font-mono text-[10.5px] uppercase tracking-[0.16em] text-ink-3">Movement 01 &middot; Day 1 – 8 &middot; 8 lessons</div>
            </div>
            <div class="font-mono text-[11px] font-semibold uppercase tracking-[0.16em] text-olive">All 8 completed &check;</div>
        </div>

        @foreach ($portal['creation_lessons'] as $lesson)
            <div class="grid grid-cols-[44px_1fr] items-center gap-4 border-b border-hair py-4 last:border-0 md:grid-cols-[44px_1fr_auto_auto_auto] md:gap-6">
                <div class="font-display text-xl font-extrabold tracking-[-0.03em] text-ink">{{ str_pad((string) $lesson['day'], 2, '0', STR_PAD_LEFT) }}</div>
                <div class="min-w-0">
                    <div class="truncate font-display text-[17px] font-bold leading-tight tracking-[-0.02em] text-ink">{{ $lesson['title'] }}</div>
                    <div class="mt-1 font-mono text-[10.5px] uppercase tracking-[0.14em] text-muted">{{ $lesson['scrip'] }}</div>
                </div>
                <div class="col-span-2 flex items-center gap-2 font-mono text-[10.5px] font-medium uppercase tracking-[0.14em] md:col-span-1">
                    <span class="inline-flex size-4 items-center justify-center rounded-full bg-olive text-white"><x-portal.icon name="check" :size="9" /></span>
                    <span class="text-ink-3">Completed</span>
                </div>
                <div class="hidden font-mono text-[10.5px] uppercase tracking-[0.14em] text-muted md:block">12 min</div>
                <div class="col-span-2 md:col-span-1"><x-portal.button variant="soft">Review</x-portal.button></div>
            </div>
        @endforeach

        <x-portal.button variant="soft" class="mt-4">+ Show all 8 lessons</x-portal.button>
    </div>
</div>

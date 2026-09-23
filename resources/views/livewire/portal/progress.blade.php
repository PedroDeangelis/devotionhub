@php
    $portal = config('portal');
    $today = $portal['today_day'];
    $total = $portal['total_days'];
    $pct = (int) round($today / $total * 100);
@endphp

<div>
    <x-portal.page-head
        eyebrow="Your Growth"
        title="Quiet progress<br>matters."
        sub="Every day you return to Scripture, you are building something lasting. Streaks fade. Habits remain." />

    <div class="flex flex-col items-center gap-10 rounded-[26px] bg-black p-8 text-white lg:flex-row lg:p-12">
        <div class="relative flex-none">
            <x-portal.progress-ring :value="$today / $total" :size="200" :stroke="10" track="rgba(255,255,255,.1)" />
            <div class="absolute inset-0 flex flex-col items-center justify-center">
                <div class="font-display text-[52px] font-extrabold leading-none tracking-[-0.04em]">
                    <em class="not-italic text-gold">{{ $pct }}</em>%
                </div>
                <div class="mt-1 font-mono text-[10px] uppercase tracking-[0.16em] text-white/55">Day {{ $today }} of {{ $total }}</div>
            </div>
        </div>

        <div class="min-w-0 flex-1">
            <div class="inline-flex items-center gap-2.5 font-mono text-[10.5px] font-medium uppercase tracking-[0.22em] text-gold-soft">
                <span class="size-1.5 rounded-full bg-gold"></span> Day {{ $today }} of {{ $total }}
            </div>
            <h2 class="mt-3.5 font-display text-[clamp(32px,3.6vw,46px)] font-bold leading-[1.02] tracking-[-0.032em] text-white">
                You've been<br>walking for {{ $today }} days.
            </h2>

            <div class="mt-8 grid grid-cols-2 gap-6 border-t border-white/10 pt-6 sm:grid-cols-4">
                @foreach ([['Completed', $today - 1, false], ['Remaining', $total - $today + 1, false], ['Streak', $portal['streak'], true], ['Next milestone', 'Day 14', false]] as [$label, $value, $gold])
                    <div>
                        <div class="font-mono text-[9.5px] font-medium uppercase tracking-[0.16em] text-white/45">{{ $label }}</div>
                        <div @class(['mt-2 font-display text-[32px] font-extrabold leading-none tracking-[-0.035em]', 'text-gold' => $gold, 'text-white' => ! $gold])>{{ $value }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <x-portal.eyebrow class="mb-5 mt-10">Milestones along the way</x-portal.eyebrow>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($portal['milestones'] as $milestone)
            <div @class([
                'flex flex-col rounded-[20px] border p-6',
                'border-olive/40 bg-paper' => $milestone['done'],
                'border-gold bg-gold-light/40' => $milestone['next'],
                'border-hair bg-paper/60 opacity-70' => ! $milestone['done'] && ! $milestone['next'],
            ])>
                <span @class([
                    'inline-flex size-11 items-center justify-center rounded-full',
                    'bg-olive text-white' => $milestone['done'],
                    'bg-gold text-white' => $milestone['next'],
                    'bg-bg-deep text-muted' => ! $milestone['done'] && ! $milestone['next'],
                ])>
                    <x-portal.icon :name="$milestone['done'] ? 'check' : ($milestone['next'] ? 'flame' : 'compass')" :size="18" />
                </span>
                <div class="mt-4 font-display text-lg font-bold leading-tight tracking-[-0.022em] text-ink">{{ $milestone['name'] }}</div>
                <div class="mt-2 text-[13px] leading-[1.5] text-ink-3">{{ $milestone['desc'] }}</div>
                @if ($milestone['next'])
                    <div class="mt-2.5 font-mono text-[10px] font-semibold uppercase tracking-[0.16em] text-gold">&nearr; 2 days away</div>
                @endif
            </div>
        @endforeach
    </div>

    <div class="mt-6 flex flex-wrap items-center justify-between gap-6 rounded-[20px] border border-hair bg-paper p-8 lg:p-10">
        <div class="max-w-[52ch]">
            <div class="font-display text-[28px] font-bold leading-[1.15] tracking-[-0.028em] text-ink">
                The goal is not perfection.<br>The goal is <em class="not-italic text-gold">returning</em>.
            </div>
            <p class="mt-3 text-sm leading-[1.6] text-ink-3">
                Missed a few days? That's okay. The path is still here. We'll meet you wherever you left off.
            </p>
        </div>
        <div class="flex flex-none flex-wrap gap-3">
            <x-portal.button variant="soft">View streak history</x-portal.button>
            <x-portal.button variant="primary" :href="route('portal.lesson')" wire:navigate arrow>Continue where I left off</x-portal.button>
        </div>
    </div>
</div>

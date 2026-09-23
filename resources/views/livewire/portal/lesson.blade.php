@php
    $portal = config('portal');
    $today = $portal['today_day'];
    $total = $portal['total_days'];
    $pct = (int) round($today / $total * 100);
@endphp

<div x-data="{ prayerDone: false, completed: false, saved: false }">
    {{-- Head --}}
    <div class="mb-9 border-b border-hair pb-8">
        <div class="flex flex-wrap items-center gap-2 font-mono text-[10.5px] uppercase tracking-[0.16em] text-muted">
            <a href="{{ route('portal.journey') }}" wire:navigate class="transition-colors hover:text-ink">Journey</a>
            <span class="text-gold">/</span>
            <span>Movement 03 &middot; Abraham</span>
            <span class="text-gold">/</span>
            <b class="font-semibold text-ink">Day {{ $today }}</b>
        </div>

        <x-portal.eyebrow class="mt-5">Day {{ $today }} of {{ $total }}</x-portal.eyebrow>

        <h1 class="mt-4 font-display text-[clamp(38px,4.4vw,58px)] font-bold leading-[0.96] tracking-[-0.035em]">
            Abraham's<br>ultimate test of faith.
        </h1>

        <div class="mt-5 flex flex-wrap items-center gap-2.5 font-mono text-[10.5px] uppercase tracking-[0.16em] text-ink-3">
            <span>Genesis 22</span><span class="text-gold">/</span>
            <span>12 min read</span><span class="text-gold">/</span>
            <span>Foundations Journey</span><span class="text-gold">/</span>
            <span class="font-semibold text-gold">{{ $pct }}% complete</span>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-[1fr_320px]">
        <div class="flex flex-col gap-4">
            {{-- Content blocks, authored in the admin --}}
            @php $step = 0; @endphp
            @foreach ($lesson?->blocks ?? [] as $block)
                @php $step += $block->type->isNumbered() ? 1 : 0; @endphp
                <x-blocks.renderer
                    :type="$block->type"
                    :data="$block->payload()"
                    mode="view"
                    :number="$block->type->isNumbered() ? str_pad((string) $step, 2, '0', STR_PAD_LEFT) : null" />
            @endforeach

            @if (! $lesson || $lesson->blocks->isEmpty())
                <div class="rounded-[20px] border border-dashed border-hair bg-paper p-10 text-center">
                    <p class="text-[15px] text-ink-3">This lesson has no content yet.</p>
                </div>
            @endif
        </div>

        {{-- Aside --}}
        <aside class="flex flex-col gap-4">
            <div class="rounded-[20px] border border-hair bg-paper p-6">
                <div class="flex items-center gap-4">
                    <x-portal.progress-ring :value="$today / $total" :size="88" :stroke="6" />
                    <div>
                        <div class="font-mono text-[10px] font-medium uppercase tracking-[0.2em] text-muted">Journey</div>
                        <div class="mt-1.5 font-display text-[22px] font-bold leading-none tracking-[-0.025em]">Day {{ $today }} / {{ $total }}</div>
                        <div class="mt-1.5 text-[12px] text-ink-3">{{ $pct }}% complete &middot; {{ $portal['streak'] }}-day streak</div>
                    </div>
                </div>

                <div class="mt-6 border-t border-hair pt-4">
                    <div class="mb-3 font-mono text-[10px] font-medium uppercase tracking-[0.2em] text-muted">Lesson steps</div>
                    @foreach ([['Today\'s reading', '5m', 'done'], ['The teaching', '4m', 'done'], ['Reflection', '2m', 'current'], ['Prayer', '1m', ''], ['Complete', '·', '']] as [$name, $min, $state])
                        <div class="flex items-center gap-3 py-2">
                            <span @class([
                                'inline-flex size-[18px] flex-none items-center justify-center rounded-full border',
                                'border-olive bg-olive text-white' => $state === 'done',
                                'border-gold bg-gold text-white' => $state === 'current',
                                'border-hair-soft' => $state === '',
                            ])>
                                @if ($state !== '')<x-portal.icon name="check" :size="10" />@endif
                            </span>
                            <span @class(['flex-1 text-[13px]', 'font-semibold text-ink' => $state === 'current', 'text-ink-3' => $state !== 'current'])>{{ $name }}</span>
                            <span class="font-mono text-[10px] uppercase tracking-[0.14em] text-muted">{{ $min }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="rounded-[20px] border border-transparent bg-bg-deep p-6">
                <x-portal.eyebrow>Next milestone</x-portal.eyebrow>
                <div class="mt-4 flex items-center gap-4">
                    <x-portal.progress-ring :value="$today / 14" :size="64" :stroke="5" color="var(--color-ink)" />
                    <div>
                        <div class="font-mono text-[10px] font-medium uppercase tracking-[0.2em] text-muted">2 days away</div>
                        <div class="mt-1.5 font-display text-2xl font-bold leading-none tracking-[-0.025em]">First 14 days</div>
                    </div>
                </div>
                <x-portal.button variant="soft" size="block" class="mt-4" :href="route('portal.progress')" wire:navigate>View progress</x-portal.button>
            </div>

            <div class="rounded-[20px] border border-hair bg-paper p-6">
                <div class="font-mono text-[10px] font-medium uppercase tracking-[0.2em] text-muted">Tomorrow &middot; Day 13</div>
                <div class="mt-2 font-display text-[22px] font-bold leading-none tracking-[-0.025em]">Isaac and Rebekah</div>
                <div class="mt-2 font-mono text-[10.5px] uppercase tracking-[0.14em] text-gold">Genesis 24 &middot; 11 min</div>
                <p class="mt-3.5 text-[13.5px] leading-[1.55] text-ink-3">
                    A servant, a well, a quiet answer to prayer. How God's promises move through ordinary moments.
                </p>
            </div>
        </aside>
    </div>
</div>

@php
    $portal = config('portal');
    $history = $portal['prayer_history'];
@endphp

<div>
    <x-portal.page-head
        eyebrow="Prayer"
        title="Bring today<br>before God."
        sub="Use simple guided prompts to pray through what you are learning. Private. Yours. Unhurried." />

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-[1.4fr_1fr]">
        <div class="rounded-[20px] border border-hair bg-paper p-6 lg:p-8">
            <span class="inline-flex items-center gap-2 rounded-full bg-gold-light px-3 py-1.5 font-mono text-[10px] font-semibold uppercase tracking-[0.14em] text-gold">
                <x-portal.icon name="prayer" :size="11" /> Based on Day {{ $portal['today_day'] }} &middot; Abraham
            </span>

            <h3 class="mt-5 font-display text-[28px] font-bold leading-[1.08] tracking-[-0.028em]">
                Ask God to help you trust Him<br>with what feels uncertain.
            </h3>

            <div class="mt-6 rounded-[14px] border-l-[3px] border-gold bg-bg px-5 py-4 font-display text-[19px] font-medium leading-[1.45] tracking-[-0.015em] text-ink">
                Father, what You have given, I receive with open hands. What You ask back, I release in trust.
                Teach me to believe You are good — even when I cannot see the outcome.
            </div>

            <textarea rows="8"
                      class="mt-5 w-full rounded-[14px] border border-hair bg-bg px-5 py-4 text-[15px] leading-[1.7] text-ink-2 transition-colors placeholder:text-hair-soft focus:border-ink focus:outline-none"
                      placeholder="Write your prayer in your own words…"></textarea>

            <div class="mt-4 flex flex-wrap items-center gap-3">
                <x-portal.button variant="primary">Save prayer</x-portal.button>
                <x-portal.button variant="soft">Pray silently</x-portal.button>
                <span class="inline-flex items-center gap-2 font-mono text-[10.5px] uppercase tracking-[0.16em] text-muted">
                    <x-portal.icon name="lock" :size="11" /> Private by default
                </span>
            </div>
        </div>

        <div class="rounded-[20px] border border-hair bg-paper p-6 lg:p-8">
            <div class="flex items-center justify-between">
                <h4 class="font-display text-xl font-bold leading-none tracking-[-0.025em]">Prayer history</h4>
                <span class="font-mono text-[10px] uppercase tracking-[0.14em] text-muted">{{ count($history) }}</span>
            </div>
            <p class="mt-1.5 text-[13px] text-ink-3">Saved prayers from the journey so far.</p>

            <div class="mt-4">
                @foreach ($history as $prayer)
                    <div class="border-b border-hair py-4 last:border-0">
                        <span class="font-mono text-[9.5px] uppercase tracking-[0.18em] text-muted">{{ $prayer['date'] }}</span>
                        <span class="mt-1.5 block font-display text-[15px] font-bold tracking-[-0.02em] text-ink">{{ $prayer['lesson'] }}</span>
                        <span class="mt-1.5 block text-[13px] leading-[1.55] text-ink-3">"{{ $prayer['preview'] }}"</span>
                    </div>
                @endforeach
            </div>

            <x-portal.button variant="soft" size="block" class="mt-5" arrow>See all saved prayers</x-portal.button>
        </div>
    </div>
</div>

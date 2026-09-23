@php
    $entries = config('reflections');
@endphp

<div x-data="{ active: 0, entries: {{ Illuminate\Support\Js::from($entries) }} }">
    <x-portal.page-head
        eyebrow="Private Journal"
        title="Your reflections."
        sub="A quiet place to collect what you're learning, praying, and noticing throughout the journey. Private by default. Searchable across every day.">
        <x-slot:actions>
            <x-portal.button variant="soft"><x-portal.icon name="download" :size="14" /> Export</x-portal.button>
            <x-portal.button variant="primary" :href="route('portal.lesson')" wire:navigate><x-portal.icon name="plus" :size="14" /> New reflection</x-portal.button>
        </x-slot:actions>
    </x-portal.page-head>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-[340px_1fr]">
        {{-- List --}}
        <div class="flex max-h-[820px] flex-col gap-2.5 overflow-y-auto pr-1">
            <div class="flex items-center gap-2.5 rounded-xl border border-hair bg-paper px-3.5 py-3 text-[13px] text-ink-3">
                <x-portal.icon name="search" :size="14" />
                <span>Search {{ count($entries) }} reflections…</span>
                <span class="ml-auto font-mono text-[10px] uppercase tracking-[0.14em] text-muted">{{ count($entries) }}</span>
            </div>

            @foreach ($entries as $i => $entry)
                <button type="button" x-on:click="active = {{ $i }}"
                        class="rounded-[14px] border p-4 text-left transition-all"
                        x-bind:class="active === {{ $i }} ? 'border-ink bg-paper shadow-card' : 'border-hair bg-paper hover:border-hair-soft'">
                    <div class="flex items-center gap-2 font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">
                        Day {{ $entry['day'] }}
                        @if ($entry['fav'])
                            <span class="text-gold"><x-portal.icon name="star" :size="11" /></span>
                        @endif
                    </div>
                    <div class="mt-2 font-display text-[15px] font-bold leading-tight tracking-[-0.02em] text-ink">{{ $entry['title'] }}</div>
                    <div class="mt-2 line-clamp-2 text-[12.5px] leading-[1.5] text-ink-3">{{ $entry['text'] }}</div>
                    <div class="mt-2.5 font-mono text-[9.5px] uppercase tracking-[0.16em] text-muted">{{ $entry['date'] }}</div>
                </button>
            @endforeach
        </div>

        {{-- Editor --}}
        <div class="rounded-[20px] border border-hair bg-paper p-6 lg:p-8">
            <div class="flex flex-wrap items-center justify-between gap-4 border-b border-hair pb-5">
                <div class="flex items-center gap-3">
                    <span class="rounded-full bg-ink px-3 py-1.5 font-mono text-[10px] font-semibold uppercase tracking-[0.14em] text-white"
                          x-text="'Day ' + entries[active].day"></span>
                    <span class="font-mono text-[10.5px] uppercase tracking-[0.16em] text-muted" x-text="entries[active].date"></span>
                </div>
                <div class="flex gap-2.5">
                    <x-portal.button variant="soft" class="px-3.5 py-2.5">
                        <x-portal.icon name="star" :size="13" />
                        <span x-text="entries[active].fav ? 'Favorited' : 'Favorite'">Favorite</span>
                    </x-portal.button>
                    <x-portal.button variant="soft" class="px-3.5 py-2.5"><x-portal.icon name="share" :size="13" /> Share</x-portal.button>
                </div>
            </div>

            <h3 class="mt-6 font-display text-[30px] font-bold leading-[1.05] tracking-[-0.028em]" x-text="entries[active].title"></h3>

            <div class="mt-5 rounded-[14px] border border-hair bg-bg px-5 py-4">
                <div class="font-mono text-[10px] font-medium uppercase tracking-[0.22em] text-muted">Reflection question</div>
                <div class="mt-2.5 font-display text-lg font-semibold leading-[1.3] tracking-[-0.02em] text-ink" x-text="entries[active].question"></div>
            </div>

            <textarea rows="12"
                      class="mt-5 w-full rounded-[14px] border border-hair bg-bg px-5 py-4 text-[15px] leading-[1.7] text-ink-2 transition-colors focus:border-ink focus:outline-none"
                      x-model="entries[active].text"></textarea>

            <div class="mt-4 flex flex-wrap items-center gap-3">
                <x-portal.button variant="primary">Save changes</x-portal.button>
                <x-portal.button variant="soft">Cancel</x-portal.button>
                <span class="font-mono text-[10.5px] uppercase tracking-[0.16em] text-olive">&check; Auto-saved &middot; <span x-text="entries[active].date"></span></span>
            </div>
        </div>
    </div>
</div>

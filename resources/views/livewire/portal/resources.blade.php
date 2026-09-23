@php
    $portal = config('portal');
@endphp

<div x-data="{ openFaq: 0 }">
    <x-portal.page-head
        eyebrow="Resources"
        title="Companions<br>for the journey."
        sub="A small, intentional library. We add to it slowly — only what helps you walk." />

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($portal['resources'] as $resource)
            <div class="group flex flex-col rounded-[20px] border border-hair bg-paper p-6 transition-all hover:-translate-y-0.5 hover:border-hair-soft">
                <span class="inline-flex size-12 items-center justify-center rounded-[14px] bg-bg-deep text-ink transition-colors group-hover:bg-gold group-hover:text-white">
                    <x-portal.icon :name="$resource['icon']" :size="22" />
                </span>
                <h3 class="mt-5 font-display text-[21px] font-bold leading-tight tracking-[-0.025em] text-ink">{{ $resource['title'] }}</h3>
                <p class="mt-2.5 flex-1 text-[13.5px] leading-[1.55] text-ink-3">{{ $resource['desc'] }}</p>
                <div class="mt-6 flex items-center justify-between border-t border-hair pt-4 font-mono text-[10px] font-medium uppercase tracking-[0.16em]">
                    <span class="text-muted">{{ $resource['kind'] }}</span>
                    <span class="inline-flex items-center gap-2 text-gold">
                        {{ $resource['action'] }}
                        <span class="arrow-mask h-2 w-3 bg-current transition-transform group-hover:translate-x-0.5"></span>
                    </span>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8 rounded-[20px] border border-hair bg-paper p-6 lg:p-10">
        <x-portal.eyebrow>Frequently asked</x-portal.eyebrow>
        <h3 class="mt-3 font-display text-[28px] font-bold leading-none tracking-[-0.028em]">Quick answers, calmly given.</h3>

        <div class="mt-7">
            @foreach ($portal['faqs'] as $i => $faq)
                <div class="border-b border-hair last:border-0">
                    <button type="button" x-on:click="openFaq = openFaq === {{ $i }} ? -1 : {{ $i }}"
                            class="flex w-full items-center justify-between gap-6 py-5 text-left">
                        <span class="font-display text-[17px] font-bold leading-tight tracking-[-0.02em] text-ink">{{ $faq['q'] }}</span>
                        <span class="inline-flex size-7 flex-none items-center justify-center rounded-full border border-hair text-ink-3 transition-transform"
                              x-bind:class="openFaq === {{ $i }} && 'rotate-45 border-gold bg-gold text-white'">
                            <x-portal.icon name="plus" :size="14" />
                        </span>
                    </button>
                    <div x-show="openFaq === {{ $i }}" x-collapse x-cloak>
                        <p class="pb-5 pr-12 text-[14px] leading-[1.65] text-ink-2">{{ $faq['a'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

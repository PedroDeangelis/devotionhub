@props(['type', 'data' => [], 'mode' => 'view', 'number' => null, 'model' => null])

@php
    $text = (string) ($data['text'] ?? '');
    $highlight = trim((string) ($data['highlight'] ?? ''));
@endphp

<section class="rounded-[20px] border border-hair bg-bg-deep p-6 lg:px-9 lg:py-8">
    <x-blocks.step-label :number="$number" :label="$type->label()" />

    <x-blocks.field :mode="$mode" :model="$model ? $model.'.heading' : null" :value="$data['heading'] ?? ''" tag="h3"
                    placeholder="Heading"
                    class="mt-4 font-display text-[26px] font-bold leading-[1.05] tracking-[-0.025em]" />

    @if ($mode === 'edit')
        <x-blocks.field mode="edit" as="textarea" :model="$model.'.text'" :value="$text"
                        placeholder="The prayer"
                        class="mt-4 font-display text-[22px] font-semibold leading-[1.3] tracking-[-0.022em] text-ink" />
        <x-blocks.field mode="edit" :model="$model.'.highlight'" :value="$highlight"
                        placeholder="Phrase to highlight in gold (optional)"
                        class="mt-3 font-mono text-[11px] uppercase tracking-[0.16em] text-gold" />
    @else
        <p class="mt-4 font-display text-[22px] font-semibold leading-[1.3] tracking-[-0.022em] text-ink">
            {!! $highlight !== ''
                ? str_replace(e($highlight), '<span class="text-gold">'.e($highlight).'</span>', nl2br(e($text)))
                : nl2br(e($text)) !!}
        </p>
        <div class="mt-6 flex flex-wrap items-center gap-3" x-data="{ prayerDone: false }">
            <template x-if="! prayerDone">
                <button type="button" x-on:click="prayerDone = true"
                        class="inline-flex items-center gap-2.5 rounded-full border border-ink px-[18px] py-3 text-[13.5px] font-semibold leading-none text-ink transition-all hover:-translate-y-px hover:bg-ink hover:text-white">
                    <x-portal.icon name="check" :size="14" /> Mark prayer complete
                </button>
            </template>
            <template x-if="prayerDone">
                <span class="inline-flex items-center gap-2.5 text-[13.5px] font-semibold text-ink">
                    <span class="inline-flex size-[18px] items-center justify-center rounded-full bg-olive text-white">
                        <x-portal.icon name="check" :size="11" />
                    </span>
                    Prayer marked complete
                </span>
            </template>
        </div>
    @endif
</section>

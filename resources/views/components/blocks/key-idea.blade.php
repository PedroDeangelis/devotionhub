@props(['type', 'data' => [], 'mode' => 'view', 'number' => null, 'model' => null])

@php
    $text = (string) ($data['text'] ?? '');
    $highlight = trim((string) ($data['highlight'] ?? ''));
@endphp

<div class="rounded-[20px] bg-black p-8 text-white lg:p-10">
    <div class="flex items-center gap-2.5 font-mono text-[10.5px] uppercase tracking-[0.22em] text-white/70">
        <span class="inline-flex size-[22px] items-center justify-center rounded-md bg-gold text-white">
            <x-portal.icon name="star" :size="12" />
        </span>
        <x-blocks.field :mode="$mode" tag="span" :model="$model ? $model.'.eyebrow' : null" :value="$data['eyebrow'] ?? ''"
                        placeholder="Key idea"
                        class="{{ $mode === 'edit' ? 'max-w-[320px] border-white/20 bg-white/10 text-white' : '' }}" />
    </div>

    @if ($mode === 'edit')
        <x-blocks.field mode="edit" as="textarea" :model="$model.'.text'" :value="$text"
                        placeholder="The idea, in a sentence or two"
                        class="mt-5 border-white/20 bg-white/10 font-display text-[28px] font-bold leading-[1.15] tracking-[-0.025em] text-white placeholder:text-white/40" />
        <x-blocks.field mode="edit" :model="$model.'.highlight'" :value="$highlight"
                        placeholder="Word to highlight in gold (optional)"
                        class="mt-3 border-white/20 bg-white/10 font-mono text-[11px] uppercase tracking-[0.16em] text-gold placeholder:text-white/40" />
    @else
        <div class="mt-5 font-display text-[28px] font-bold leading-[1.15] tracking-[-0.025em] text-white">
            {!! $highlight !== ''
                ? str_replace(e($highlight), '<span class="text-gold">'.e($highlight).'</span>', nl2br(e($text)))
                : nl2br(e($text)) !!}
        </div>
    @endif
</div>

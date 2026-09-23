@props(['type', 'data' => [], 'mode' => 'view', 'number' => null, 'model' => null])

<div class="flex flex-wrap items-center justify-between gap-6 rounded-[20px] bg-black p-8 text-white lg:p-10">
    <div class="min-w-0 max-w-[46ch] flex-1">
        <x-blocks.field :mode="$mode" :model="$model ? $model.'.eyebrow' : null" :value="$data['eyebrow'] ?? ''"
                        placeholder="Eyebrow"
                        class="font-mono text-[10.5px] uppercase tracking-[0.22em] text-gold-soft {{ $mode === 'edit' ? 'border-white/20 bg-white/10' : '' }}" />

        <x-blocks.field :mode="$mode" :model="$model ? $model.'.heading' : null" :value="$data['heading'] ?? ''" tag="h3"
                        placeholder="Heading"
                        class="mt-3.5 font-display text-[28px] font-bold leading-[1.05] tracking-[-0.028em] text-white {{ $mode === 'edit' ? 'border-white/20 bg-white/10 placeholder:text-white/40' : '' }}" />

        <x-blocks.field :mode="$mode" as="textarea" tag="p" :model="$model ? $model.'.text' : null" :value="$data['text'] ?? ''"
                        placeholder="Closing note"
                        class="mt-3 text-sm leading-[1.6] text-white/65 {{ $mode === 'edit' ? 'border-white/20 bg-white/10 placeholder:text-white/40' : '' }}" />
    </div>

    @if ($mode === 'edit')
        <x-blocks.field mode="edit" :model="$model.'.button'" :value="$data['button'] ?? ''"
                        placeholder="Button label"
                        class="w-auto min-w-[200px] border-white/20 bg-white/10 text-sm font-semibold text-white placeholder:text-white/40" />
    @else
        <button type="button"
                class="group inline-flex items-center gap-2.5 rounded-full bg-white px-6 py-4 text-sm font-semibold leading-none text-black transition-transform hover:-translate-y-px">
            {{ $data['button'] ?? '' }}
            <span class="arrow-mask h-2.5 w-3.5 bg-current transition-transform group-hover:translate-x-0.5"></span>
        </button>
    @endif
</div>

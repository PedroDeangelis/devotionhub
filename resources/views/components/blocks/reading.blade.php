@props(['type', 'data' => [], 'mode' => 'view', 'number' => null, 'model' => null])

<section class="rounded-[20px] border border-hair bg-paper p-6 lg:px-9 lg:py-8">
    <x-blocks.step-label :number="$number" :label="$type->label()" />

    <x-blocks.field :mode="$mode" :model="$model ? $model.'.heading' : null" :value="$data['heading'] ?? ''" tag="h3"
                    placeholder="Heading"
                    class="mt-4 font-display text-[26px] font-bold leading-[1.05] tracking-[-0.025em]" />

    <x-blocks.field :mode="$mode" as="textarea" tag="p" :model="$model ? $model.'.intro' : null" :value="$data['intro'] ?? ''"
                    placeholder="Introduction"
                    class="mt-3 text-[14.5px] leading-[1.65] text-ink-2" />

    <div class="mt-6 flex flex-wrap items-center justify-between gap-4 rounded-[14px] border border-hair bg-bg px-5 py-4">
        <div class="min-w-0 flex-1">
            <x-blocks.field :mode="$mode" :model="$model ? $model.'.reference' : null" :value="$data['reference'] ?? ''"
                            placeholder="Genesis 22"
                            class="font-display text-lg font-bold tracking-[-0.02em] text-ink" />
            <x-blocks.field :mode="$mode" :model="$model ? $model.'.meta' : null" :value="$data['meta'] ?? ''"
                            placeholder="KJV · 19 verses · approx 5 min"
                            class="mt-1 font-mono text-[10px] uppercase tracking-[0.16em] text-muted" />
        </div>
        <x-portal.button variant="primary" arrow>Open passage</x-portal.button>
    </div>
</section>

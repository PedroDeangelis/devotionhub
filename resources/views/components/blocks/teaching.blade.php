@props(['type', 'data' => [], 'mode' => 'view', 'number' => null, 'model' => null])

<section class="rounded-[20px] border border-hair bg-paper p-6 lg:px-9 lg:py-8">
    <x-blocks.step-label :number="$number" :label="$type->label()" />

    <x-blocks.field :mode="$mode" :model="$model ? $model.'.heading' : null" :value="$data['heading'] ?? ''" tag="h3"
                    placeholder="Heading"
                    class="mt-4 font-display text-[26px] font-bold leading-[1.05] tracking-[-0.025em]" />

    <x-blocks.body :body="$data['body'] ?? []" :mode="$mode"
                   :model="$model ? $model.'.body' : null"
                   :group="'teaching-'.($model ?? 'view')" />
</section>

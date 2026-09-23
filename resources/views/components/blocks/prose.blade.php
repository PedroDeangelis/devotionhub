@props(['type', 'data' => [], 'mode' => 'view', 'number' => null, 'model' => null])

<section class="rounded-[20px] border border-hair bg-paper p-6 lg:px-9 lg:py-8">
    @if ($mode === 'edit')
        <x-blocks.step-label :label="$type->label()" />
    @endif

    <x-blocks.body :body="$data['body'] ?? []" :mode="$mode"
                   :model="$model ? $model.'.body' : null"
                   :group="'prose-'.($model ?? 'view')" />
</section>

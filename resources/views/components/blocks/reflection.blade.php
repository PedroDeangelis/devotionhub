@props(['type', 'data' => [], 'mode' => 'view', 'number' => null, 'model' => null])

<section class="rounded-[20px] border border-hair bg-paper p-6 lg:px-9 lg:py-8">
    <x-blocks.step-label :number="$number" :label="$type->label()" />

    <x-blocks.field :mode="$mode" :model="$model ? $model.'.heading' : null" :value="$data['heading'] ?? ''" tag="h3"
                    placeholder="The reflection question"
                    class="mt-4 font-display text-[26px] font-bold leading-[1.05] tracking-[-0.025em]" />

    <x-blocks.field :mode="$mode" as="textarea" tag="p" :model="$model ? $model.'.helper' : null" :value="$data['helper'] ?? ''"
                    placeholder="Helper text"
                    class="mt-2.5 text-[14.5px] leading-[1.65] text-ink-2" />

    {{-- The student's own writing surface. In edit mode this is a dead preview:
         it is a student affordance, not content the admin authors. --}}
    @if ($mode === 'edit')
        <div class="mt-5 rounded-[14px] border border-dashed border-hair bg-bg px-5 py-4 text-[15px] text-muted">
            <x-blocks.field mode="edit" :model="$model.'.placeholder'" :value="$data['placeholder'] ?? ''"
                            placeholder="Placeholder shown in the student's empty textarea"
                            class="text-[13px] text-ink-3" />
            <div class="mt-3 font-mono text-[10px] uppercase tracking-[0.16em] text-muted">Student writes here</div>
        </div>
    @else
        <textarea rows="6"
                  class="mt-5 w-full rounded-[14px] border border-hair bg-bg px-5 py-4 text-[15px] leading-[1.6] text-ink-2 transition-colors placeholder:text-hair-soft focus:border-ink focus:outline-none"
                  placeholder="{{ $data['placeholder'] ?? '' }}"></textarea>
        <div class="mt-4 flex flex-wrap items-center gap-3">
            <x-portal.button variant="primary">Save reflection</x-portal.button>
            <x-portal.button variant="soft">Save &amp; continue</x-portal.button>
        </div>
    @endif
</section>

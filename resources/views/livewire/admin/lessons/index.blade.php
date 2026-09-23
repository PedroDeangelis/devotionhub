<div>
    <a href="{{ route('admin.courses.index') }}" wire:navigate
       class="inline-flex items-center gap-2 font-mono text-[10.5px] uppercase tracking-[0.16em] text-muted transition-colors hover:text-ink">
        <x-admin.icon name="arrow-left" :size="14" /> Courses
    </a>

    <div class="mb-9 mt-5 flex flex-wrap items-end justify-between gap-6">
        <div>
            <div class="inline-flex items-center gap-2.5 font-mono text-[10.5px] font-medium uppercase tracking-[0.22em] text-ink-3">
                <span class="size-1.5 rounded-full bg-gold"></span> {{ $course->title }}
            </div>
            <h1 class="mb-3.5 mt-[18px] font-display text-[clamp(38px,4vw,54px)] font-bold leading-[0.98] tracking-[-0.032em]">Lessons.</h1>
            <p class="max-w-[60ch] text-[15px] leading-[1.6] text-ink-3">Drag to reorder. Open a lesson to build its content.</p>
        </div>

        <a href="{{ route('admin.lessons.create', $course) }}" wire:navigate
           class="inline-flex items-center gap-2.5 rounded-full bg-black px-6 py-4 text-sm font-semibold leading-none text-white transition-transform hover:-translate-y-px">
            <x-admin.icon name="plus" :size="15" /> New lesson
        </a>
    </div>

    @if ($lessons->isEmpty())
        <div class="rounded-[20px] border border-dashed border-hair bg-paper p-12 text-center">
            <p class="text-[15px] text-ink-3">This course has no lessons yet.</p>
        </div>
    @else
        <div x-sort="$wire.reorder($item, $position)" x-sort:config="{ animation: 160 }"
             x-sort:group="lessons" class="flex flex-col gap-3">
            @foreach ($lessons as $lesson)
                <div wire:key="lesson-{{ $lesson->id }}" x-sort:item="{{ $lesson->id }}"
                     class="group flex flex-wrap items-center gap-4 rounded-[16px] border border-hair bg-paper p-4 transition-colors hover:border-hair-soft">

                    <button type="button" x-sort:handle
                            class="inline-flex size-9 flex-none cursor-grab items-center justify-center rounded-lg border border-hair text-ink-3 transition-colors hover:text-ink active:cursor-grabbing"
                            aria-label="Reorder {{ $lesson->title }}">
                        <x-admin.icon name="grip" :size="15" />
                    </button>

                    @if ($lesson->day_number)
                        <span class="font-display text-xl font-extrabold tracking-[-0.03em] text-gold">{{ str_pad((string) $lesson->day_number, 2, '0', STR_PAD_LEFT) }}</span>
                    @endif

                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-2.5">
                            <span class="font-display text-[17px] font-bold tracking-[-0.02em] text-ink">{{ $lesson->title }}</span>
                            @unless ($lesson->is_published)
                                <span class="rounded-full border border-hair px-2.5 py-1 font-mono text-[9.5px] font-semibold uppercase tracking-[0.14em] text-muted">Draft</span>
                            @endunless
                        </div>
                        <div class="mt-1 font-mono text-[10.5px] uppercase tracking-[0.14em] text-muted">
                            {{ $lesson->scripture_reference ?: 'No reference' }} &middot; {{ $lesson->blocks_count }} {{ Str::plural('block', $lesson->blocks_count) }}
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.lessons.edit', $lesson) }}" wire:navigate
                           class="inline-flex items-center gap-2 rounded-full border border-hair bg-paper px-4 py-2.5 text-[13px] font-semibold text-ink transition-colors hover:border-ink">
                            Build
                        </a>
                        <button type="button" wire:click="delete({{ $lesson->id }})"
                                wire:confirm="Delete “{{ $lesson->title }}” and all its blocks?"
                                class="inline-flex size-9 items-center justify-center rounded-lg border border-hair text-ink-3 transition-colors hover:border-[#B33] hover:text-[#B33]"
                                aria-label="Delete {{ $lesson->title }}">
                            <x-admin.icon name="trash" :size="15" />
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

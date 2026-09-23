<div>
    <div class="mb-9 flex flex-wrap items-end justify-between gap-6">
        <div>
            <div class="inline-flex items-center gap-2.5 font-mono text-[10.5px] font-medium uppercase tracking-[0.22em] text-ink-3">
                <span class="size-1.5 rounded-full bg-gold"></span> Content
            </div>
            <h1 class="mb-3.5 mt-[18px] font-display text-[clamp(38px,4vw,54px)] font-bold leading-[0.98] tracking-[-0.032em]">Courses.</h1>
            <p class="max-w-[60ch] text-[15px] leading-[1.6] text-ink-3">
                Every journey students can walk. Drag to reorder.
            </p>
        </div>

        <a href="{{ route('admin.courses.create') }}" wire:navigate
           class="inline-flex items-center gap-2.5 rounded-full bg-black px-6 py-4 text-sm font-semibold leading-none text-white transition-transform hover:-translate-y-px">
            <x-admin.icon name="plus" :size="15" /> New course
        </a>
    </div>

    @if (session('status'))
        <div class="mb-5 rounded-[12px] border border-olive/30 bg-olive/10 px-4 py-3 text-[13.5px] text-ink">{{ session('status') }}</div>
    @endif

    @if ($courses->isEmpty())
        <div class="rounded-[20px] border border-dashed border-hair bg-paper p-12 text-center">
            <p class="text-[15px] text-ink-3">No courses yet.</p>
            <a href="{{ route('admin.courses.create') }}" wire:navigate
               class="mt-5 inline-flex items-center gap-2.5 rounded-full bg-black px-5 py-3 text-[13.5px] font-semibold text-white">
                <x-admin.icon name="plus" :size="14" /> Create the first course
            </a>
        </div>
    @else
        <div x-sort="$wire.reorder($item, $position)" x-sort:config="{ animation: 160 }"
             x-sort:group="courses" class="flex flex-col gap-3">
            @foreach ($courses as $course)
                <div wire:key="course-{{ $course->id }}" x-sort:item="{{ $course->id }}"
                     class="group flex flex-wrap items-center gap-4 rounded-[16px] border border-hair bg-paper p-4 transition-colors hover:border-hair-soft">

                    <button type="button" x-sort:handle
                            class="inline-flex size-9 flex-none cursor-grab items-center justify-center rounded-lg border border-hair text-ink-3 transition-colors hover:text-ink active:cursor-grabbing"
                            aria-label="Reorder {{ $course->title }}">
                        <x-admin.icon name="grip" :size="15" />
                    </button>

                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-2.5">
                            <span class="font-display text-[19px] font-bold tracking-[-0.022em] text-ink">{{ $course->title }}</span>
                            @if ($course->is_published)
                                <span class="rounded-full border border-olive/40 bg-olive/10 px-2.5 py-1 font-mono text-[9.5px] font-semibold uppercase tracking-[0.14em] text-olive">Published</span>
                            @else
                                <span class="rounded-full border border-hair px-2.5 py-1 font-mono text-[9.5px] font-semibold uppercase tracking-[0.14em] text-muted">Draft</span>
                            @endif
                        </div>
                        <div class="mt-1 font-mono text-[10.5px] uppercase tracking-[0.14em] text-muted">
                            {{ $course->lessons_count }} {{ Str::plural('lesson', $course->lessons_count) }} &middot; /{{ $course->slug }}
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        <a href="{{ route('admin.lessons.index', $course) }}" wire:navigate
                           class="inline-flex items-center gap-2 rounded-full border border-hair bg-paper px-4 py-2.5 text-[13px] font-semibold text-ink transition-colors hover:border-ink">
                            Lessons
                        </a>
                        <a href="{{ route('admin.courses.edit', $course) }}" wire:navigate
                           class="inline-flex size-9 items-center justify-center rounded-lg border border-hair text-ink-3 transition-colors hover:border-ink hover:text-ink"
                           aria-label="Edit {{ $course->title }}">
                            <x-admin.icon name="pencil" :size="15" />
                        </a>
                        <button type="button" wire:click="delete({{ $course->id }})"
                                wire:confirm="Delete “{{ $course->title }}” and all its lessons? This cannot be undone."
                                class="inline-flex size-9 items-center justify-center rounded-lg border border-hair text-ink-3 transition-colors hover:border-[#B33] hover:text-[#B33]"
                                aria-label="Delete {{ $course->title }}">
                            <x-admin.icon name="trash" :size="15" />
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

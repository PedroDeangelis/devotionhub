<div>
    <a href="{{ route('admin.lessons.index', $course) }}" wire:navigate
       class="inline-flex items-center gap-2 font-mono text-[10.5px] uppercase tracking-[0.16em] text-muted transition-colors hover:text-ink">
        <x-admin.icon name="arrow-left" :size="14" /> {{ $course->title }}
    </a>

    <h1 class="mb-8 mt-5 font-display text-[clamp(34px,3.6vw,46px)] font-bold leading-[0.98] tracking-[-0.032em]">
        {{ $lesson ? $lesson->title : 'New lesson.' }}
    </h1>

    @if (session('status'))
        <div class="mb-5 rounded-[12px] border border-olive/30 bg-olive/10 px-4 py-3 text-[13.5px] text-ink">{{ session('status') }}</div>
    @endif

    <form wire:submit="save" class="mb-8 grid grid-cols-1 gap-5 rounded-[20px] border border-hair bg-paper p-6 lg:grid-cols-2 lg:p-8">
        <div class="lg:col-span-2">
            <label for="title" class="mb-2 block font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">Title</label>
            <input id="title" wire:model.blur="title" type="text"
                   class="w-full rounded-[11px] border border-hair bg-bg px-4 py-3 text-[15px] transition-colors focus:border-ink focus:outline-none">
            @error('title') <p class="mt-2 text-[13px] text-[#9B3B3B]">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="slug" class="mb-2 block font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">Slug</label>
            <input id="slug" wire:model="slug" type="text"
                   class="w-full rounded-[11px] border border-hair bg-bg px-4 py-3 font-mono text-[14px] transition-colors focus:border-ink focus:outline-none">
            @error('slug') <p class="mt-2 text-[13px] text-[#9B3B3B]">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="scripture_reference" class="mb-2 block font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">Scripture reference</label>
            <input id="scripture_reference" wire:model="scripture_reference" type="text" placeholder="Genesis 22"
                   class="w-full rounded-[11px] border border-hair bg-bg px-4 py-3 text-[15px] transition-colors focus:border-ink focus:outline-none">
        </div>

        <div>
            <label for="day_number" class="mb-2 block font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">Day number</label>
            <input id="day_number" wire:model="day_number" type="number" min="1"
                   class="w-full rounded-[11px] border border-hair bg-bg px-4 py-3 text-[15px] transition-colors focus:border-ink focus:outline-none">
            @error('day_number') <p class="mt-2 text-[13px] text-[#9B3B3B]">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="estimated_minutes" class="mb-2 block font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">Minutes</label>
            <input id="estimated_minutes" wire:model="estimated_minutes" type="number" min="1"
                   class="w-full rounded-[11px] border border-hair bg-bg px-4 py-3 text-[15px] transition-colors focus:border-ink focus:outline-none">
        </div>

        <div class="lg:col-span-2">
            <label for="summary" class="mb-2 block font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">Summary <span class="normal-case tracking-normal">(shown on tomorrow's card)</span></label>
            <textarea id="summary" wire:model="summary" rows="2"
                      class="w-full rounded-[11px] border border-hair bg-bg px-4 py-3 text-[15px] leading-[1.6] transition-colors focus:border-ink focus:outline-none"></textarea>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-4 border-t border-hair pt-5 lg:col-span-2">
            <label for="is_published" class="inline-flex cursor-pointer items-center gap-[9px] text-[13.5px] text-ink-3">
                <input id="is_published" type="checkbox" wire:model="is_published" class="size-4 cursor-pointer accent-ink">
                <span>Published — visible to students</span>
            </label>

            <button type="submit"
                    class="inline-flex items-center gap-2.5 rounded-full bg-black px-6 py-4 text-sm font-semibold leading-none text-white transition-transform hover:-translate-y-px">
                Save details
            </button>
        </div>
    </form>

    @if ($lesson)
        <livewire:admin.lessons.block-editor :lesson="$lesson" :key="'blocks-'.$lesson->id" />
    @else
        <div class="rounded-[20px] border border-dashed border-hair bg-paper p-10 text-center">
            <p class="text-[15px] text-ink-3">Save the lesson details first, then build its content.</p>
        </div>
    @endif
</div>

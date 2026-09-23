<div class="max-w-[720px]">
    <a href="{{ route('admin.courses.index') }}" wire:navigate
       class="inline-flex items-center gap-2 font-mono text-[10.5px] uppercase tracking-[0.16em] text-muted transition-colors hover:text-ink">
        <x-admin.icon name="arrow-left" :size="14" /> Courses
    </a>

    <h1 class="mb-9 mt-5 font-display text-[clamp(34px,3.6vw,46px)] font-bold leading-[0.98] tracking-[-0.032em]">
        {{ $course ? 'Edit course.' : 'New course.' }}
    </h1>

    <form wire:submit="save" class="flex flex-col gap-5 rounded-[20px] border border-hair bg-paper p-6 lg:p-8">
        <div>
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
            <label for="subtitle" class="mb-2 block font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">Subtitle</label>
            <input id="subtitle" wire:model="subtitle" type="text"
                   class="w-full rounded-[11px] border border-hair bg-bg px-4 py-3 text-[15px] transition-colors focus:border-ink focus:outline-none">
            @error('subtitle') <p class="mt-2 text-[13px] text-[#9B3B3B]">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="description" class="mb-2 block font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">Description</label>
            <textarea id="description" wire:model="description" rows="4"
                      class="w-full rounded-[11px] border border-hair bg-bg px-4 py-3 text-[15px] leading-[1.6] transition-colors focus:border-ink focus:outline-none"></textarea>
            @error('description') <p class="mt-2 text-[13px] text-[#9B3B3B]">{{ $message }}</p> @enderror
        </div>

        <label for="is_published" class="inline-flex cursor-pointer items-center gap-[9px] text-[13.5px] text-ink-3">
            <input id="is_published" type="checkbox" wire:model="is_published" class="size-4 cursor-pointer accent-ink">
            <span>Published — visible to students</span>
        </label>

        <div class="flex flex-wrap gap-3 border-t border-hair pt-5">
            <button type="submit"
                    class="inline-flex items-center gap-2.5 rounded-full bg-black px-6 py-4 text-sm font-semibold leading-none text-white transition-transform hover:-translate-y-px">
                Save course
            </button>
            <a href="{{ route('admin.courses.index') }}" wire:navigate
               class="inline-flex items-center rounded-full border border-hair bg-paper px-6 py-4 text-sm font-semibold leading-none text-ink transition-colors hover:border-ink">
                Cancel
            </a>
        </div>
    </form>
</div>

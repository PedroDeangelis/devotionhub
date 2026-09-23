@php
    /* Numbering runs over numbered blocks only, matching the student page
       where the dark cards sit outside the 01-04 sequence. */
    $step = 0;
    $numbers = [];
    foreach ($blocks as $i => $b) {
        $type = \App\Enums\BlockType::from($b['type']);
        $step += $type->isNumbered() ? 1 : 0;
        $numbers[$i] = $type->isNumbered() ? str_pad((string) $step, 2, '0', STR_PAD_LEFT) : null;
    }
@endphp

<div>
    <div class="mb-6 flex flex-wrap items-end justify-between gap-4 border-t border-hair pt-8">
        <div>
            <div class="inline-flex items-center gap-2.5 font-mono text-[10.5px] font-medium uppercase tracking-[0.22em] text-ink-3">
                <span class="size-1.5 rounded-full bg-gold"></span> Lesson content
            </div>
            <h2 class="mt-3 font-display text-[28px] font-bold leading-none tracking-[-0.028em]">Blocks.</h2>
            <p class="mt-2 max-w-[60ch] text-[14px] leading-[1.6] text-ink-3">
                Drag by the handle to reorder. Changes save when you leave a field.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <button type="button" wire:click="toggleMode"
                    class="inline-flex items-center gap-2 rounded-full border border-hair bg-paper px-4 py-2.5 text-[13px] font-semibold text-ink transition-colors hover:border-ink">
                <x-admin.icon name="eye" :size="14" />
                {{ $mode === 'edit' ? 'Preview' : 'Edit' }}
            </button>
            <button type="button" wire:click="save"
                    class="inline-flex items-center gap-2.5 rounded-full bg-black px-5 py-3 text-[13.5px] font-semibold leading-none text-white transition-transform hover:-translate-y-px">
                Save content
            </button>
        </div>
    </div>

    @if (session('status'))
        <div class="mb-5 rounded-[12px] border border-olive/30 bg-olive/10 px-4 py-3 text-[13.5px] text-ink">{{ session('status') }}</div>
    @endif

    {{-- The canvas. Left padding leaves room for the drag/delete rail. --}}
    <div x-sort="$wire.reorder($item, $position)"
         x-sort:config="{ animation: 160 }"
         x-sort:group="lesson-blocks"
         class="flex flex-col gap-4 lg:pl-12">

        @foreach ($blocks as $index => $block)
            <div wire:key="block-{{ $block['id'] }}"
                 x-sort:item="{{ $block['id'] }}"
                 class="group relative"
                 wire:loading.class="opacity-50" wire:target="reorder">

                @if ($mode === 'edit')
                    <div class="absolute -left-12 top-6 hidden flex-col items-center gap-1.5 lg:flex">
                        <button type="button" x-sort:handle
                                class="inline-flex size-8 cursor-grab items-center justify-center rounded-lg border border-hair bg-paper text-ink-3 opacity-40 transition-opacity hover:text-ink group-hover:opacity-100 active:cursor-grabbing"
                                aria-label="Reorder block">
                            <x-admin.icon name="grip" :size="15" />
                        </button>
                        <button type="button" x-sort:ignore
                                wire:click="deleteBlock({{ $block['id'] }})"
                                wire:confirm="Delete this block?"
                                class="inline-flex size-8 items-center justify-center rounded-lg border border-hair bg-paper text-ink-3 opacity-40 transition-opacity hover:border-[#B33] hover:text-[#B33] group-hover:opacity-100"
                                aria-label="Delete block">
                            <x-admin.icon name="trash" :size="14" />
                        </button>
                    </div>
                @endif

                {{-- x-sort:ignore keeps a mousedown inside a field from starting a drag. --}}
                <div @if ($mode === 'edit') x-sort:ignore @endif>
                    <x-blocks.renderer
                        :type="$block['type']"
                        :data="$block['data']"
                        :mode="$mode"
                        :number="$numbers[$index] ?? null"
                        :model="'blocks.'.$index.'.data'" />
                </div>
            </div>
        @endforeach
    </div>

    @if (empty($blocks))
        <div class="rounded-[20px] border border-dashed border-hair bg-paper p-12 text-center lg:ml-12">
            <p class="text-[15px] text-ink-3">No blocks yet. Add one below to start building this lesson.</p>
        </div>
    @endif

    {{-- Add-block palette --}}
    <div class="mt-8 rounded-[20px] border border-hair bg-bg-deep p-6 lg:ml-12">
        <div class="font-mono text-[10px] font-medium uppercase tracking-[0.2em] text-muted">Add a block</div>
        <div class="mt-4 grid grid-cols-1 gap-2.5 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($types as $type)
                <button type="button" wire:click="addBlock('{{ $type->value }}')"
                        class="group/add flex flex-col rounded-[14px] border border-hair bg-paper p-4 text-left transition-all hover:-translate-y-0.5 hover:border-ink">
                    <span class="flex items-center gap-2 font-display text-[15px] font-bold tracking-[-0.02em] text-ink">
                        <x-admin.icon name="plus" :size="13" class="text-gold" />
                        {{ $type->label() }}
                    </span>
                    <span class="mt-1.5 text-[12.5px] leading-[1.45] text-ink-3">{{ $type->description() }}</span>
                </button>
            @endforeach
        </div>
    </div>
</div>

@props(['body' => [], 'mode' => 'view', 'model' => null, 'group' => 'body'])

<div class="mt-4 flex flex-col gap-3.5 text-[14.5px] leading-[1.7] text-ink-2"
     @if ($mode === 'edit') x-sort="$wire.reorderBodyItem('{{ $model }}', $item, $position)" x-sort:group="{{ $group }}" @endif>

    @foreach ($body as $i => $item)
        @php $isQuote = ($item['kind'] ?? 'paragraph') === 'quote'; @endphp

        @if ($mode === 'edit')
            <div wire:key="{{ $group }}-{{ $i }}" x-sort:item="{{ $i }}" class="group/item relative">
                <div class="absolute -left-9 top-1 flex flex-col gap-1 opacity-40 transition-opacity group-hover/item:opacity-100">
                    <button type="button" x-sort:handle
                            class="inline-flex size-7 cursor-grab items-center justify-center rounded-md border border-hair bg-paper text-ink-3 active:cursor-grabbing"
                            aria-label="Reorder">
                        <x-admin.icon name="grip" :size="13" />
                    </button>
                    <button type="button" x-sort:ignore wire:click="removeBodyItem('{{ $model }}', {{ $i }})"
                            class="inline-flex size-7 items-center justify-center rounded-md border border-hair bg-paper text-ink-3 transition-colors hover:border-gold hover:text-gold"
                            aria-label="Remove">
                        <x-admin.icon name="trash" :size="13" />
                    </button>
                </div>

                <div x-sort:ignore>
                    <x-blocks.field mode="edit" as="textarea"
                                    :model="$model.'.'.$i.'.text'" :value="$item['text'] ?? ''"
                                    :placeholder="$isQuote ? 'Pull-quote' : 'Paragraph'"
                                    class="{{ $isQuote
                                        ? 'border-l-[3px] border-l-gold font-display text-[21px] font-semibold leading-[1.25] tracking-[-0.022em] text-ink'
                                        : 'text-[14.5px] leading-[1.7] text-ink-2' }}" />
                </div>
            </div>
        @elseif ($isQuote)
            <div class="my-2 border-l-[3px] border-gold py-1 pl-5 font-display text-[21px] font-semibold leading-[1.25] tracking-[-0.022em] text-ink">{!! nl2br(e($item['text'] ?? '')) !!}</div>
        @else
            <p>{!! nl2br(e($item['text'] ?? '')) !!}</p>
        @endif
    @endforeach
</div>

@if ($mode === 'edit')
    <div class="mt-3 flex gap-2">
        <button type="button" wire:click="addBodyItem('{{ $model }}', 'paragraph')"
                class="inline-flex items-center gap-1.5 rounded-full border border-hair bg-paper px-3 py-1.5 font-mono text-[10px] uppercase tracking-[0.14em] text-ink-3 transition-colors hover:border-ink hover:text-ink">
            <x-admin.icon name="plus" :size="11" /> Paragraph
        </button>
        <button type="button" wire:click="addBodyItem('{{ $model }}', 'quote')"
                class="inline-flex items-center gap-1.5 rounded-full border border-hair bg-paper px-3 py-1.5 font-mono text-[10px] uppercase tracking-[0.14em] text-ink-3 transition-colors hover:border-gold hover:text-gold">
            <x-admin.icon name="plus" :size="11" /> Pull-quote
        </button>
    </div>
@endif

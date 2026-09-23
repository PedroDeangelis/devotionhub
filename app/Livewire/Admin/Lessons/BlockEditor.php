<?php

namespace App\Livewire\Admin\Lessons;

use App\Enums\BlockType;
use App\Models\Lesson;
use App\Models\LessonBlock;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Locked;
use Livewire\Component;

/**
 * The drag-and-drop canvas for one lesson's content blocks.
 *
 * Blocks are held as a plain array rather than a model collection: binding
 * wire:model into an Eloquent array-cast property writes to a copy, so edits
 * would silently never persist.
 */
class BlockEditor extends Component
{
    #[Locked]
    public int $lessonId;

    /** @var array<int, array{id: int, type: string, data: array<string, mixed>}> */
    public array $blocks = [];

    public string $mode = 'edit';

    public function mount(Lesson $lesson): void
    {
        $this->lessonId = $lesson->id;
        $this->loadBlocks();
    }

    /**
     * Persist whenever a bound block field changes.
     *
     * wire:model.blur syncs the property but does not itself write to the
     * database; hooking updated() runs after the property is set, so there is
     * no race between the sync and the save.
     */
    public function updated(string $name): void
    {
        if (preg_match('/^blocks\.(\d+)\./', $name, $matches) === 1) {
            $this->saveBlock((int) $matches[1]);
        }
    }

    public function toggleMode(): void
    {
        $this->mode = $this->mode === 'edit' ? 'view' : 'edit';
    }

    public function addBlock(string $type): void
    {
        $blockType = BlockType::from($type);

        LessonBlock::create([
            'lesson_id' => $this->lessonId,
            'type' => $blockType,
            'data' => $blockType->defaults(),
            'position' => (int) $this->scope()->max('position') + 1,
        ]);

        $this->loadBlocks();
    }

    public function deleteBlock(int $id): void
    {
        $this->scope()->whereKey($id)->delete();

        LessonBlock::resequence($this->scope());

        $this->loadBlocks();
    }

    public function reorder(int $id, int $position): void
    {
        LessonBlock::moveToPosition($this->scope(), $id, $position);

        $this->loadBlocks();
    }

    /**
     * Persist one block, validated against its own type's ruleset.
     *
     * Called on blur from any field in the block. Only the validated subset is
     * written back, so a crafted request cannot inject extra keys into the
     * JSON column.
     */
    public function saveBlock(int $index): void
    {
        $block = $this->blocks[$index] ?? null;

        if ($block === null) {
            return;
        }

        $type = BlockType::from($block['type']);

        $validated = $this->validate($type->rules("blocks.{$index}.data"));

        /** @var array<string, mixed> $data */
        $data = data_get($validated, "blocks.{$index}.data", []);

        $this->scope()->whereKey($block['id'])->update(['data' => $data]);
    }

    /**
     * Persist every block. Used by the explicit Save button.
     */
    public function save(): void
    {
        foreach (array_keys($this->blocks) as $index) {
            $this->saveBlock($index);
        }

        $this->dispatch('blocks-saved');

        session()->flash('status', 'Lesson content saved.');
    }

    /* ---- nested body items (teaching, prose) ---- */

    public function addBodyItem(string $path, string $kind): void
    {
        $body = (array) data_get($this, $path, []);
        $body[] = ['kind' => $kind, 'text' => ''];

        data_set($this, $path, array_values($body));

        $this->saveBlockForPath($path);
    }

    public function removeBodyItem(string $path, int $index): void
    {
        $body = (array) data_get($this, $path, []);
        unset($body[$index]);

        data_set($this, $path, array_values($body));

        $this->saveBlockForPath($path);
    }

    public function reorderBodyItem(string $path, int $from, int $to): void
    {
        $body = array_values((array) data_get($this, $path, []));

        if (! array_key_exists($from, $body)) {
            return;
        }

        $moved = $body[$from];
        array_splice($body, $from, 1);
        array_splice($body, max(0, min($to, count($body))), 0, [$moved]);

        data_set($this, $path, $body);

        $this->saveBlockForPath($path);
    }

    /**
     * A nested path looks like "blocks.3.data.body" - pull the index back out
     * so the whole block can be revalidated and saved.
     */
    protected function saveBlockForPath(string $path): void
    {
        if (preg_match('/^blocks\.(\d+)\./', $path, $matches) === 1) {
            $this->saveBlock((int) $matches[1]);
        }
    }

    protected function loadBlocks(): void
    {
        $this->blocks = $this->scope()
            ->orderBy('position')
            ->get()
            ->map(fn (LessonBlock $block): array => [
                'id' => $block->id,
                'type' => $block->type->value,
                'data' => $block->payload(),
            ])
            ->all();
    }

    /**
     * Every query is scoped to the mounted lesson, so a tampered block id in a
     * request payload can never reach another lesson's rows.
     *
     * @return Builder<LessonBlock>
     */
    protected function scope(): Builder
    {
        return LessonBlock::query()->where('lesson_id', $this->lessonId);
    }

    public function render(): View
    {
        return view('livewire.admin.lessons.block-editor', [
            'types' => BlockType::cases(),
        ]);
    }
}

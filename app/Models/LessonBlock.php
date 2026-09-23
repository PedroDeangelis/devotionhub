<?php

namespace App\Models;

use App\Enums\BlockType;
use App\Support\Ordering\ReordersPositions;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $lesson_id
 * @property BlockType $type
 * @property array<string, mixed> $data
 * @property int $position
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Lesson $lesson
 */
#[Fillable(['lesson_id', 'type', 'data', 'position'])]
class LessonBlock extends Model
{
    /** @use HasFactory<\Database\Factories\LessonBlockFactory> */
    use HasFactory;

    use ReordersPositions;

    /**
     * @return BelongsTo<Lesson, $this>
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * The stored payload merged over the type's defaults.
     *
     * Lets a block view read any key without null-coalescing, even when the row
     * was written before a field was added to the type.
     *
     * @return array<string, mixed>
     */
    public function payload(): array
    {
        return array_replace_recursive($this->type->defaults(), $this->data);
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => BlockType::class,
            'data' => 'array',
            'position' => 'integer',
        ];
    }
}

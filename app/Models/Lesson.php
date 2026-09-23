<?php

namespace App\Models;

use App\Support\Ordering\ReordersPositions;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $course_id
 * @property string $title
 * @property string $slug
 * @property string|null $scripture_reference
 * @property string|null $summary
 * @property int|null $day_number
 * @property int|null $estimated_minutes
 * @property int $position
 * @property bool $is_published
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Course $course
 * @property-read \Illuminate\Database\Eloquent\Collection<int, LessonBlock> $blocks
 */
#[Fillable([
    'course_id', 'title', 'slug', 'scripture_reference', 'summary',
    'day_number', 'estimated_minutes', 'position', 'is_published',
])]
class Lesson extends Model
{
    /** @use HasFactory<\Database\Factories\LessonFactory> */
    use HasFactory;

    use ReordersPositions;

    /**
     * @return BelongsTo<Course, $this>
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * @return HasMany<LessonBlock, $this>
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(LessonBlock::class)->orderBy('position');
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'day_number' => 'integer',
            'estimated_minutes' => 'integer',
            'position' => 'integer',
            'is_published' => 'boolean',
        ];
    }
}

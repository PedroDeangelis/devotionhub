<?php

namespace Database\Factories;

use App\Enums\BlockType;
use App\Models\Lesson;
use App\Models\LessonBlock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LessonBlock>
 */
class LessonBlockFactory extends Factory
{
    protected $model = LessonBlock::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lesson_id' => Lesson::factory(),
            'type' => BlockType::Prose,
            'data' => BlockType::Prose->defaults(),
            'position' => 0,
        ];
    }

    public function ofType(BlockType $type): self
    {
        return $this->state(fn (): array => [
            'type' => $type,
            'data' => $type->defaults(),
        ]);
    }
}

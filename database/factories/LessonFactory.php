<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Lesson>
 */
class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(4);

        return [
            'course_id' => Course::factory(),
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(1, 99999),
            'scripture_reference' => 'Genesis '.fake()->numberBetween(1, 50),
            'summary' => fake()->sentence(12),
            'day_number' => fake()->numberBetween(1, 90),
            'estimated_minutes' => 12,
            'position' => 0,
            'is_published' => true,
        ];
    }
}

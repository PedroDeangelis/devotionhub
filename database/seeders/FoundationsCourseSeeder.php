<?php

namespace Database\Seeders;

use App\Enums\BlockType;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonBlock;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * The 90-Day Foundations course.
 *
 * Day 12 carries the exact copy that was previously hardcoded into
 * resources/views/livewire/portal/lesson.blade.php, so moving the student page
 * onto the database changes nothing a reader can see. The remaining lessons in
 * the Abraham movement come from config/portal.php and are titles only.
 */
class FoundationsCourseSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::updateOrCreate(
            ['slug' => '90-day-foundations'],
            [
                'title' => '90-Day Foundations',
                'subtitle' => 'From Genesis to Jesus',
                'description' => 'A guided daily journey through the story of Scripture — ninety days, seven movements, twelve minutes a day.',
                'position' => 0,
                'is_published' => true,
            ],
        );

        foreach (config('portal.abraham_lessons', []) as $index => $entry) {
            $lesson = Lesson::updateOrCreate(
                ['course_id' => $course->id, 'slug' => Str::slug($entry['title'])],
                [
                    'title' => $entry['title'],
                    'scripture_reference' => $entry['scrip'],
                    'day_number' => $entry['day'],
                    'estimated_minutes' => 12,
                    'position' => $index,
                    'is_published' => $entry['state'] !== 'locked',
                    'summary' => $entry['day'] === 13
                        ? "A servant, a well, a quiet answer to prayer. How God's promises move through ordinary moments."
                        : null,
                ],
            );

            if ($entry['day'] === 12) {
                $this->seedDayTwelveBlocks($lesson);
            }
        }
    }

    private function seedDayTwelveBlocks(Lesson $lesson): void
    {
        $lesson->blocks()->delete();

        foreach ($this->dayTwelveBlocks() as $position => [$type, $data]) {
            LessonBlock::create([
                'lesson_id' => $lesson->id,
                'type' => $type,
                'data' => $data,
                'position' => $position,
            ]);
        }
    }

    /**
     * @return list<array{0: BlockType, 1: array<string, mixed>}>
     */
    private function dayTwelveBlocks(): array
    {
        return [
            [BlockType::Reading, [
                'heading' => 'Read Genesis 22 slowly.',
                'intro' => 'Notice what Abraham is asked to surrender. Notice the quiet of the three-day walk. Notice how God speaks — and when. Notice the ram, caught in the thicket, just in time.',
                'reference' => 'Genesis 22',
                'meta' => 'KJV · 19 verses · approx 5 min',
            ]],

            [BlockType::Teaching, [
                'heading' => "Trust when the promise\nfeels impossible.",
                'body' => [
                    ['kind' => 'paragraph', 'text' => 'Few sentences in Scripture land with the weight of Genesis 22:2. "Take now thy son, thine only son Isaac, whom thou lovest…" For twenty-five years, Abraham had waited for this child. Sarah had laughed. The bones had grown old. And then, against every reasonable expectation, the promise came — laughing, growing, his.'],
                    ['kind' => 'paragraph', 'text' => 'And now, with the promise standing in front of him, God asks for him back.'],
                    ['kind' => 'paragraph', 'text' => 'This is not a story about a cruel God. It is a story about a faith that has learned something we are still learning: that the One who gives the gift is greater than the gift itself. That the God who provided once will provide again. That obedience and trust are not the same thing — but they grow up together.'],
                    ['kind' => 'quote', 'text' => 'Faith is not pretending the test is easy. Faith is trusting the One who provides.'],
                    ['kind' => 'paragraph', 'text' => 'The mountain has a name. Moriah. It is the same hill, tradition tells us, on which another Father would one day climb with another only Son — and this time, no ram would be caught in the thicket. The Lamb would be the Son. The provision would be the cost.'],
                ],
            ]],

            [BlockType::KeyIdea, [
                'eyebrow' => 'Key idea — Day 12',
                'text' => "God is not only the One who calls us to trust.\nHe is also the One who provides.",
                'highlight' => 'provides',
            ]],

            [BlockType::Reflection, [
                'heading' => "What is one area where God may\nbe inviting you to surrender control?",
                'helper' => 'Sit with this before you write. There is no rush. The Spirit often speaks in the second or third pause, not the first.',
                'placeholder' => 'Write your private reflection. Encrypted. Yours alone.',
            ]],

            [BlockType::Prayer, [
                'heading' => 'A prayer for today.',
                'text' => 'Father, what You have given, I receive with open hands. What You ask back, I release in trust.',
                'highlight' => 'trust.',
            ]],

            [BlockType::Complete, [
                'eyebrow' => "You've reached the end of Day 12",
                'heading' => "You've completed Day 12.",
                'text' => "Reflection saved. Prayer marked. Tomorrow's lesson — Isaac and Rebekah — will be waiting at 7:00 AM.",
                'button' => 'Complete Day 12',
            ]],
        ];
    }
}

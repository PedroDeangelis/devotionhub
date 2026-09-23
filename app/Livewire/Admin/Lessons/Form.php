<?php

namespace App\Livewire\Admin\Lessons;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Form extends Component
{
    public ?Lesson $lesson = null;

    public Course $course;

    public string $title = '';

    public string $slug = '';

    public string $scripture_reference = '';

    public string $summary = '';

    public ?int $day_number = null;

    public ?int $estimated_minutes = 12;

    public bool $is_published = false;

    public function mount(?Course $course = null, ?Lesson $lesson = null): void
    {
        if ($lesson?->exists) {
            $this->lesson = $lesson;
            $this->course = $lesson->course;
            $this->title = $lesson->title;
            $this->slug = $lesson->slug;
            $this->scripture_reference = (string) $lesson->scripture_reference;
            $this->summary = (string) $lesson->summary;
            $this->day_number = $lesson->day_number;
            $this->estimated_minutes = $lesson->estimated_minutes;
            $this->is_published = $lesson->is_published;

            return;
        }

        $this->course = $course ?? abort(404);
    }

    public function updatedTitle(string $value): void
    {
        if (! $this->lesson) {
            $this->slug = Str::slug($value);
        }
    }

    public function save(): void
    {
        $data = $this->validate([
            'title' => ['required', 'string', 'max:160'],
            'slug' => [
                'required', 'string', 'max:160', 'alpha_dash',
                Rule::unique('lessons', 'slug')
                    ->where('course_id', $this->course->id)
                    ->ignore($this->lesson?->id),
            ],
            'scripture_reference' => ['nullable', 'string', 'max:120'],
            'summary' => ['nullable', 'string', 'max:500'],
            'day_number' => ['nullable', 'integer', 'min:1', 'max:9999'],
            'estimated_minutes' => ['nullable', 'integer', 'min:1', 'max:999'],
            'is_published' => ['boolean'],
        ]);

        if ($this->lesson) {
            $this->lesson->update($data);
            session()->flash('status', 'Lesson saved.');

            return;
        }

        $data['course_id'] = $this->course->id;
        $data['position'] = (int) Lesson::query()->where('course_id', $this->course->id)->max('position') + 1;

        $lesson = Lesson::create($data);

        $this->redirectRoute('admin.lessons.edit', $lesson, navigate: true);
    }

    #[Layout('layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.lessons.form');
    }
}

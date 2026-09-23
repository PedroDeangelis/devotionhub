<?php

namespace App\Livewire\Admin\Courses;

use App\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Form extends Component
{
    public ?Course $course = null;

    public string $title = '';

    public string $slug = '';

    public string $subtitle = '';

    public string $description = '';

    public bool $is_published = false;

    public function mount(?Course $course = null): void
    {
        if ($course?->exists) {
            $this->course = $course;
            $this->title = $course->title;
            $this->slug = $course->slug;
            $this->subtitle = (string) $course->subtitle;
            $this->description = (string) $course->description;
            $this->is_published = $course->is_published;
        }
    }

    /**
     * Fill the slug from the title only while creating.
     *
     * Regenerating it on every edit would silently break existing links.
     */
    public function updatedTitle(string $value): void
    {
        if (! $this->course) {
            $this->slug = Str::slug($value);
        }
    }

    public function save(): void
    {
        $data = $this->validate([
            'title' => ['required', 'string', 'max:160'],
            'slug' => [
                'required', 'string', 'max:160', 'alpha_dash',
                Rule::unique('courses', 'slug')->ignore($this->course?->id),
            ],
            'subtitle' => ['nullable', 'string', 'max:200'],
            'description' => ['nullable', 'string', 'max:2000'],
            'is_published' => ['boolean'],
        ]);

        if ($this->course) {
            $this->course->update($data);
        } else {
            $data['position'] = (int) Course::query()->max('position') + 1;
            $this->course = Course::create($data);
        }

        session()->flash('status', 'Course saved.');

        $this->redirectRoute('admin.courses.index', navigate: true);
    }

    #[Layout('layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.courses.form');
    }
}

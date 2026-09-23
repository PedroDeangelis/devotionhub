<?php

namespace App\Livewire\Admin\Lessons;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Index extends Component
{
    #[Locked]
    public int $courseId;

    public function mount(Course $course): void
    {
        $this->courseId = $course->id;
    }

    public function reorder(int $id, int $position): void
    {
        Lesson::moveToPosition($this->scope(), $id, $position);
    }

    public function delete(int $id): void
    {
        $this->scope()->whereKey($id)->delete();

        Lesson::resequence($this->scope());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder<Lesson>
     */
    protected function scope(): \Illuminate\Database\Eloquent\Builder
    {
        return Lesson::query()->where('course_id', $this->courseId);
    }

    #[Layout('layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.lessons.index', [
            'course' => Course::findOrFail($this->courseId),
            'lessons' => $this->scope()
                ->withCount('blocks')
                ->orderBy('position')
                ->get(),
        ]);
    }
}

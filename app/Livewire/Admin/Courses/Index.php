<?php

namespace App\Livewire\Admin\Courses;

use App\Models\Course;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public function reorder(int $id, int $position): void
    {
        Course::moveToPosition(Course::query(), $id, $position);
    }

    public function delete(int $id): void
    {
        Course::query()->whereKey($id)->delete();

        Course::resequence(Course::query());
    }

    #[Layout('layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.courses.index', [
            'courses' => Course::query()
                ->withCount('lessons')
                ->orderBy('position')
                ->get(),
        ]);
    }
}

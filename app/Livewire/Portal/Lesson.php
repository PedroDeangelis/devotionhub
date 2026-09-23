<?php

namespace App\Livewire\Portal;

use App\Models\Lesson as LessonModel;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Lesson extends Component
{
    /**
     * Today's lesson, resolved from the configured day number.
     *
     * Progress is not modelled per user yet, so "today" comes from config the
     * same way the rest of the portal's progress figures do.
     */
    protected function lesson(): ?LessonModel
    {
        return LessonModel::query()
            ->with('blocks')
            ->where('day_number', config('portal.today_day'))
            ->where('is_published', true)
            ->first();
    }

    #[Layout('layouts.portal')]
    public function render(): View
    {
        return view('livewire.portal.lesson', [
            'lesson' => $this->lesson(),
        ]);
    }
}

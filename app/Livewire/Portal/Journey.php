<?php

namespace App\Livewire\Portal;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Journey extends Component
{
    #[Layout('layouts.portal')]
    public function render(): View
    {
        return view('livewire.portal.journey');
    }
}

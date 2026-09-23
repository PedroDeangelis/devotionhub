<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.dashboard', [
            'totalUsers' => User::count(),
            'adminUsers' => User::where('is_admin', true)->count(),
            'recentUsers' => User::latest()->take(8)->get(),
        ]);
    }
}

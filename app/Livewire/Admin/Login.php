<?php

namespace App\Livewire\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        /*
         * A valid student signing in here is authenticated but not authorised.
         * Sign them straight back out so a non-admin session is never created
         * from the admin login form, and say so plainly.
         */
        if (! Auth::user()->is_admin) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => __('This account does not have administrator access.'),
            ]);
        }

        session()->regenerate();

        $this->redirectIntended(route('admin.dashboard'), navigate: true);
    }

    #[Layout('layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.login');
    }
}

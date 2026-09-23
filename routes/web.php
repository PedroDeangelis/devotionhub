<?php

use App\Livewire\Admin;
use App\Livewire\Auth\Login;
use App\Livewire\Portal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('login', Login::class)
    ->middleware('guest')
    ->name('login');

Route::post('logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout');

/*
 * There is no public marketing site: the root URL is the student dashboard.
 * Guests hitting it are sent to the login by `redirectGuestsTo` in
 * bootstrap/app.php, and returned here once they authenticate.
 */
Route::middleware('auth')->group(function () {
    Route::redirect('/', '/portal/dashboard')->name('home');

    Route::prefix('portal')->name('portal.')->group(function () {
        Route::get('dashboard', Portal\Dashboard::class)->name('dashboard');
        Route::get('lesson', Portal\Lesson::class)->name('lesson');
        Route::get('journey', Portal\Journey::class)->name('journey');
        Route::get('reflections', Portal\Reflections::class)->name('reflections');
        Route::get('prayer', Portal\Prayer::class)->name('prayer');
        Route::get('progress', Portal\Progress::class)->name('progress');
        Route::get('resources', Portal\Resources::class)->name('resources');
        Route::get('settings', Portal\Settings::class)->name('settings');
        Route::get('completion', Portal\Completion::class)->name('completion');
    });
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', Admin\Login::class)
        ->middleware('guest')
        ->name('login');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', Admin\Dashboard::class)->name('dashboard');

        Route::get('courses', Admin\Courses\Index::class)->name('courses.index');
        Route::get('courses/create', Admin\Courses\Form::class)->name('courses.create');
        Route::get('courses/{course}/edit', Admin\Courses\Form::class)->name('courses.edit');

        Route::get('courses/{course}/lessons', Admin\Lessons\Index::class)->name('lessons.index');
        Route::get('courses/{course}/lessons/create', Admin\Lessons\Form::class)->name('lessons.create');
        Route::get('lessons/{lesson}/edit', Admin\Lessons\Form::class)->name('lessons.edit');
    });
});

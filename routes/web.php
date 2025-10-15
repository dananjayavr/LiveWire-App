<?php

use App\Livewire\ArticleIndex;
use App\Livewire\ShowArticle;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', ArticleIndex::class)->name('home');

//Route::get('/search',Search::class)->name('search');
Route::get('/articles/{article}', ShowArticle::class)->name('article');
Route::get('/dashboard',\App\Livewire\Dashboard::class)->name('dashboard');
Route::get('/dashboard/articles',\App\Livewire\ArticleList::class)->name('article-list');
Route::get('/dashboard/articles/create',\App\Livewire\CreateArticle::class)->name('article-create');
Route::get('/dashboard/articles/{article}/edit',\App\Livewire\EditArticle::class)->name('article-update');

//Route::view('dashboard', 'dashboard')
//    ->middleware(['auth', 'verified'])
//    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';

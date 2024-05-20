<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

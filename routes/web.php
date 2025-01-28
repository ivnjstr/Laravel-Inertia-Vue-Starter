<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('/', 'Home')->name('home');
});

// Route::inertia('/', 'Home')->middleware('verified')->name('home');

require __DIR__ . '/auth.php'; //import the auth document

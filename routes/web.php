<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home')->name('home');

require __DIR__ . '/auth.php'; //import the auth document

Route::get('/test-db', function () {
    dd(env('DB_DATABASE'), file_exists(env('DB_DATABASE')));
});
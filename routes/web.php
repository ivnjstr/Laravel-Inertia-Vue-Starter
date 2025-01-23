<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home')->name('home');

//Now create a Route for register
Route::get('/register', [RegisterController::class, 'create'])->name('register');

//now create "create" this method to our RegisterConroller.php
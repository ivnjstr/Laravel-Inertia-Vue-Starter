<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home')->name('home');

//Now create a Route for register
Route::get('/register', [RegisterController::class, 'create'])->name('register');
//now create "create" this method to our RegisterConroller.php

//for form submittion route > copy the route register and change to post
Route::post('/register', [RegisterController::class, 'store']);
//the function called store and we dont need a name since it will be inherited from the get route.
// Now go to registerController to create a public funtion
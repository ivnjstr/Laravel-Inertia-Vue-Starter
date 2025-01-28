<?php

//Now create a Route for register

use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () { 
    //----------------Register--------------------//
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    //now create "create" this method to our RegisterConroller.php

    //for form submittion route > copy the route register and change to post
    Route::post('/register', [RegisterController::class, 'store']);
    //the function called store and we dont need a name since it will be inherited from the get route.
    // Now go to registerController to create a public funtion

    //----------------Login--------------------//
    Route::get('/login', [AuthenticateController::class, 'create'])->name('login');
    // we also have a method to handle that login 
    Route::post('/login', [AuthenticateController::class, 'store']);
});
//Also we want to apply the guest middleware to all of this and for that we can just group them so we don’t have to repeat ourselves 
// Now import this document from out web.php

   
Route::middleware('auth')->group(function () {
    //----------------Logout--------------------//
    Route::post('/logout', [AuthenticateController::class, 'destroy'])->name('logout');
    // now create function of destroy method in AuthenticateController.php
});








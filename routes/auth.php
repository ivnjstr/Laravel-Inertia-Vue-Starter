<?php

//Now create a Route for register

use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
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

    //----------------Reset Password--------------------//
    Route::get('/forgot-password', [ResetPasswordController::class, 'requestPass'])->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'sendEmail'])->name('password.email');

    //the first 2 routes are use for requesting a password and the next one are actually handling the reset password

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetForm'])->name('password.reset');
    // we have a get route that is going to show a form again and it has a {token} which is going to be a dynamic value provided by the laravel 

    Route::post('/reset-password', [ResetPasswordController::class, 'resetHandler'])->name('password.update');

});
//Also we want to apply the guest middleware to all of this and for that we can just group them so we don’t have to repeat ourselves 
// Now import this document from out web.php

   
Route::middleware('auth')->group(function () {
    //----------------Logout--------------------//
    Route::post('/logout', [AuthenticateController::class, 'destroy'])->name('logout');
    // now create function of destroy method in AuthenticateController.php


    //----------------Email Verification--------------------//
    //----------------1nd route--------------------//
    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');

    //----------------2nd route--------------------//
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'handler'])->middleware('signed')->name('verification.verify');
    // we have a get route that goes to same route but we have 2 dinamic value id and hash that laravel handle filling those value  
    // in middleware delete auth and keep that signed

    //----------------3nd route--------------------//
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'] )->middleware('throttle:6,1')->name('verification.send');


    //----------------Confirm Password--------------------//
    //----------------1nd route--------------------//
    Route::get('/confirm-password', [ConfirmPasswordController::class, 'create'])->name('password.confirm');

    //----------------2nd route--------------------//
    Route::post('/confirm-password', [ConfirmPasswordController::class, 'store'])->middleware('throttle:6,1');
    //throttle:6,1 means make sure that the user doesnt make to many request
    // so the name of the route is gonna be the same  > password.confirm > copy the name and paste it to submit method of the Confirm password.vue component
});

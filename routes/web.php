<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth'])->group(function(){
    //Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

    //Profile route
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // add annother middleware and that is password.confirm > this middleware tells laravel that user connot access this route unless they confirm their password

    Route::patch('/profile', [ProfileController::class, 'updateInfo'])->name('profile.info');
    //patch because we are going to modify some information in our database
    //we will have the same URI or path and same controller.

    Route::put('/profile', [ProfileController::class, 'updatePassword'])->name('profile.password');
    //put for update password

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //delete for delete in database
});


Route::get('/', [ListingController::class, 'index'])->name('home');
//->middleware('verified')
Route::resource('listing', ListingController::class)->except('index');
//except('index') passing the name or methods we want to exclude 



require __DIR__ . '/auth.php'; //import the auth document

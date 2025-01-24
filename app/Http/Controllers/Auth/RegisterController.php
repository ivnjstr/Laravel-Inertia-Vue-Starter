<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function create(){
        //return inertia vue
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request){
     
        // dd($request);
        //  Dump and Die is a Laravel's debugging tools. When called, it outputs the contents of the variable in a readable format and stops the script execution immediately.
        // dd we are just breaking the operation to see what we get in request objects
        //Now go back to register.vue component to create create a function called submmit

        // For Validation
        $credentials = $request->validate([
            //take an array of all the field under validation
            'name' => 'required|max:255',
            'email' => 'required|lowercase|email|max:255',
            'password' => 'required|confirmed|min:3',
        ]);

        //if the validation is pass
        $user = User::create($credentials);

        // send email verification

        Auth::login($user);

        return redirect()->route('home');
    }   
}



<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class ConfirmPasswordController extends Controller
{
    public function create(){
        return Inertia::render('Auth/ConfirmPassword');
    }

    public function store(Request $request) { // so we are accepting the request
        if (! Hash::check($request->password, $request->user()->password)) { //if this failed
            return back()->withErrors([ 
                'password' => ['The provided password does not match our records.']
            ]);
        }
     
        $request->session()->passwordConfirmed();
        //passwordConfirmed this session is available on the session  but vs code doesnt recognize this but it does work so we dont have to do anything here 

        return redirect()->intended();
        // and we are using again intended method so the user will go back to the same page before confirming their password
    }
}

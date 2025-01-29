<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    public function create() 
    {
        //our create method is going to return the login view  > firts create that inside our resources/js/pages/Auth create Login.vue
        return Inertia::render('Auth/Login', [
            'status' => session('status')
        ]);

    }

    public function store(Request $request)
    {
        // much like what we did in our register controller we just want to validate and Login the user 
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]); //we want to check if this credential is correct we would login the user otherwise return back to login page with an error message

        //Now add statement here 
        if (Auth::attempt($credentials, $request->boolean('remember')))
        {
            //if this this true means the user is Logged in
            //and we want to grab the request and to regenerate the session usingf the regenerate function on the session function
            $request->session()->regenerate();
            //this is the mwthod that laravel documentation recommend that we need to do when we are authrntication the user and then when its done we want to redirect the user to their dashboard or to the intended place.
            //example if the user about to create a post and needed to logged in they would go back to that page instead of home page.
            return redirect()->intended();
        } // do this part if the credention is correct but if its not

        return back()->withErrors([
            'email' => 'The provided credential do not match our records.'
        ])->onlyInput();
    }


    public function destroy(Request $request) { //first accept the request > Request $request
        // dd('logout');

        Auth::logout(); // then logout the user
        $request->session()->invalidate(); //invalidate the session
        $request->session()->regenerateToken(); // also regenerate the csft token

        //Note this is the part of laravel documentation

        return redirect()->route('home');
    }
}

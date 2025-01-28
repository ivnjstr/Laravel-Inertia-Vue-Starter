<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmailVerificationController extends Controller
{   
    public function notice(){
        
        //Now  Create a VerifyEmail.vue component inside the resources/js/pages/Auth folder
        return Inertia::render('Auth/VerifyEmail', [
            //we know the render function from inertia can accept a second argument that is an arrau of prop.
            'status' => session('status'),
        ]);
        //Now we have a session message or a session prop
        
    }

    //2nd Route
    public function handler(EmailVerificationRequest $request) {
     
        $request->fulfill();
        return redirect()->route('home'); // redirect to home
    }

    //3rd Route
    public function resend(Request $request) { 
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }
     
        // means we are accepting the request so we can grab the auithenricated user 
        $request->user()->sendEmailVerificationNotification();
     
        return back()->with('status', 'Verification link sent!');
        // replace the message as status that means we will have a session message with the key status
        // so we can actually grab that and sent it to the VerifyEmail.vue component as a prop so we can show it to the user 
    }
}

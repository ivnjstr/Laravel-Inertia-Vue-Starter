<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function requestPass() {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status') // now we have this prop go back to Forgotpass component add define prop
        ]);
    }

    public function sendEmail(Request $request) { //again we are accepting the request
        $request->validate(['email' => 'required|email']); // we are validating that 1 input feild
     
        $status = Password::sendResetLink(
            // "sendResetLink" send the reset pass link to the email we pass to this function "sendResetLink"
            $request->only('email')
        );
        // and then we are savinf the result of that staement inside this $status so its gives us either a success of failure
     
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);

        // means if that status message was a success of basically this RESET_LINK_SENT from password then we go back with the status message otherwise we go back with the error message  "withErrors" 
        // and we are going back to the page of ForgotPassword.vue
        // so that means we can accpet the status as a prop and send it to our vue component so we can show it to the user.
    }

    public function resetForm(Request $request) {
        //return view('auth.reset-password', ['token' => $token]);
        //now this is the laravel way we are working with vuejs and inertia > delete the return view and string $token
        return Inertia::render('Auth/ResetPassword', [
            'email' => $request->email,
            'token' => $request->route('token')
        ]); // create a ResetPassword.vue
    }

    public function resetHandler(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ]);  // so again we are accepting the request and validating oour input field
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60)); //import manually copy in laravel doc
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    // that means we need to add this status session message to our login page 
                    // Now add the session messages to out login page > In AuthenticateController
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
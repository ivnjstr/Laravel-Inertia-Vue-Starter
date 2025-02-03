<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Psy\Readline\Hoa\Console;

class ProfileController extends Controller
{
    public function edit(Request $request){
        return Inertia::render('Profile/Edit', [
            'user' => $request->user(), //and it gives as authenticated user 
            'status' => session('status'),
        ]);
        //now we are sending this prop to the edit.vue component but we need to the Updateinfo.vue
    }

    public function updateInfo(Request $request){
        
        //dd($request);
        //first we need to validate and save to database 
        $fields = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)]
            //Rule::unique(User::class) so we want this email to be unique in the user class except the currently authenticated user and for that we can use the ignore funvtion > so  means except this currently authenticated user 
        ]);  
        //so if the validation pass we want to save that new information
        $request->user()->fill($fields);

        if ($request->user()->isDirty('email')) {

            $request->user()->email_verified_at = null;

        }; // using isDirty method check if email field was change so this method will return true if the field email was change > then it will unverified the user

        $request->user()->save();

        return redirect()->route('profile.edit');
    }

    public function updatePassword(Request $request){
        $fields = $request->validate([
            'current_password' => ['required', 'current_password'],
            //[current_password] this rule  which is part of laravel rules make sure that this 'current_password' matches the currently authenticated users password and laravel behind the scene will take care of the plain string which is coming from input field 
            // if the password 
            'password' => ['required', 'confirmed', 'min:3']
        ]);

       //Save the new password if there is no error
        $request->user()->update([
            'password' => Hash::make($fields['password'])
        ]); //we want to update some information on this user

        return redirect()->route('profile.edit');
    }

    public function destroy(Request $request){
        $request->validate([
            'password' => ['required', 'current_password'] // current_password of the authenticated user 
        ]); 

        // if this correct we want to grab the user and save inside the variable 
        $user = $request->user();

        //we want to logout the user first 
        Auth::logout();

        //and delete the user 
        $user->delete();

        //similar waht we did in logout function in our AuthenticateController we want to invalidate the session and regenerate the token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        //then return back to the homepage
        return redirect()->route('home');
    }
}

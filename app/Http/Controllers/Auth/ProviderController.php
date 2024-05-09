<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        // Get the user
        $user = Socialite::driver($provider)->user();

        // Attempt to find the user by email
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // If the user already exists (it means they registered initially via email then tried to log in with provider account), 
            //Next step is to update their provider details so they can login with that provider also. 
            //Check the Provider Platform then register their id accordingly
            if ($provider == 'google') {
                $existingUser->update([
                    'provider_id_google' => $user->id,
                    'provider_token' => $user->token,
                    'email_verified_at' => now(),
                ]);
            } elseif ($provider == 'facebook') {
                $existingUser->update([
                    'provider_id_facebook' => $user->id,
                    'provider_token' => $user->token,
                    'email_verified_at' => now(),
                ]);
            } else {
                dd('Some error occured on UPDATING provider details, provider platform is not google nor facebook');
            }


            $user = $existingUser;
            Auth::login($user);
            return redirect()->route('dashboard');
        } else {

            //Prepare a new password for the user
            $password = Str::random(16);

            // If the user does not exist, create a new user
            $newUser = new User;

            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->password = Hash::make($password); // Generate a random password for the user then email them the password

            if ($provider == 'google') {
                $newUser->provider_id_google = $user->id;
            } elseif ($provider == 'facebook') {
                $newUser->provider_id_facebook = $user->id;
            } else {
                dd('Some error occured on CREATING the user, provider platform is not google nor facebook');
            }

            $newUser->provider_token = $user->token;
            $newUser->email_verified_at = now();
            $newUser->save();


            Mail::to($newUser)->send(new SendPasswordMail($password));

            $user = $newUser;
            Auth::login($user);
            return redirect()->route('dashboard')->with('firstLogin', 'An email has been sent to your account containing a temporary password.');;
        }
    }
}

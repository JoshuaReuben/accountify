<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use App\Mail\SendPasswordMail;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect(Request $request, $provider)
    {
        // Default Value to False if not set
        $adminParam = $request->input('admin', false);

        if ($adminParam == true) {
            session(['logging_in_as_admin' => true]);
        } else {
            session(['logging_in_as_admin' => false]);
        }
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {  // Get the user
            $user = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            //dd('For Local Development, download the cacert.pem and add it into your php.ini, this is the self signed certificate');
            if (session('logging_in_as_admin') == true) {
                return redirect()->route('admin.login');
            } else {
                return redirect()->route('login');
            }
        }

        // Retrieve the value from the session
        $loggingInAsAdmin = session('logging_in_as_admin', false);

        // Check if the user tries to login as Admin
        if ($loggingInAsAdmin == true) {
            $existingAdmin = Admin::where('email', $user->email)->first();
            //Fail the login attempt if no email is found in the admin table.
            if (!$existingAdmin) {
                // No admin account found with the given email
                return redirect()->route('admin.login')->with('message', 'No admin email account was found registered.');
                exit;
            }

            if ($existingAdmin) {
                // If the user already exists (it means they registered initially via email then tried to log in with provider account), 
                //Next step is to update their provider details so they can login with that provider also. 
                //Check the Provider Platform then register their id accordingly
                // Next prevent the user from logging in if they don't have an existing email.
                if ($provider == 'google') {
                    $existingAdmin->update([
                        'provider_id_google' => $user->id,
                        'provider_token' => $user->token,

                    ]);
                } elseif ($provider == 'facebook') {
                    $existingAdmin->update([
                        'provider_id_facebook' => $user->id,
                        'provider_token' => $user->token,

                    ]);
                } else {
                    dd('Some error occured on UPDATING provider details of ADMIN ACCOUNT, provider platform is not google nor facebook');
                }

                // Update email_verified_at only if it's currently null
                if ($existingAdmin->email_verified_at === null) {
                    $existingAdmin->update(['email_verified_at' => now()]);
                }

                $user = $existingAdmin;
                Auth::guard('admin')->login($user);
                return redirect()->route('admin.dashboard');
                exit;
            }
        }

        //---------------------------- PROCEED BELOW IF USER IS NOT ADMIN ---------------------------

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

                ]);
            } elseif ($provider == 'facebook') {
                $existingUser->update([
                    'provider_id_facebook' => $user->id,
                    'provider_token' => $user->token,

                ]);
            } else {
                dd('Some error occured on UPDATING provider details of USER ACCOUNT, provider platform is not google nor facebook');
            }

            // Update email_verified_at only if it's currently null
            if ($existingUser->email_verified_at === null) {
                $existingUser->update(['email_verified_at' => now()]);
            }


            $user = $existingUser;
            Auth::login($user);
            return redirect()->route('dashboard');
            exit;
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

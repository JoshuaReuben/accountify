<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminEmailVerifyController extends Controller
{

    public function verifyEmail(Request $request)
    {
        $userId = $request->route('id');
        $token = $request->route('token');

        // Find the user by ID and token
        $user = Admin::where('id', $userId)->where('token', $token)->first();
        // dd($user);

        if ($user && !$user->hasVerifiedEmail()) {
            // Mark the email as verified
            $user->email_verified_at = now();
            $user->token = null; // Nullify the token
            $user->save();

            // Redirect to a success page or dashboard
            return redirect()->route('admin.dashboard')->with('status', 'Email verified successfully!');
        } else {
            // Handle invalid token or user not found
            return redirect()->route('admin.dashboard')->with('error', 'Invalid verification link or user not found.');
        }
    }
}

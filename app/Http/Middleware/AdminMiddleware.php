<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Pass if normal auth is only needed
        // if (Auth::check()) {
        //     return $next($request);
        // }

        // For Admin Routes Only
        if (Auth::guard('admin')->check()) {


            //Verify Email First
            $user = Auth::guard('admin')->user();
            // Check if the email_verified_at field is empty
            if (empty($user->email_verified_at)) {

                // Redirect to 'admin email notice' if the email is not verified
                return redirect('/verify-email-notice');
            }


            return $next($request);
        }


        // TODO: Create new middleware for Super Admins


        abort(403, 'Only Admins can access this page.');
    }
}

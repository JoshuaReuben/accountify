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
            return $next($request);
        }


        abort(403, 'Only Admins can access this page.');
    }
}

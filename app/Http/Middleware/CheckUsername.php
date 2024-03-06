<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUsername
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {

        if (Auth::user() && Auth::user()->username == 'snpoc_admin') {
            return redirect()->route('admin');
        } elseif (Auth::user()) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login');
        }
    }
}

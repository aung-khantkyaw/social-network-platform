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
        if (Auth::check() && Auth::user()->username == 'snpoc_admin') {
            return redirect()->route('admin');
        } else {
            return redirect()->route('home');
        }

        return $next($request);
    }
}

// if (auth()->user()->username == 'snpoc_admin') {
//     Route::get('/', Admin::class)->name('admin');
// } else {
//     Route::get('/', Home::class)->name('home');
// }
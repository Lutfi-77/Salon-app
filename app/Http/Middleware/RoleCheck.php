<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Alert;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = Auth::user();
        // dd(Auth::check() && Auth::user()->role == $role);
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }
        Auth::logout();
        Alert::toast('You are not authorized to access this page.', 'error');
        return redirect()->route('home');

        // if ($request->is('admin/*')) {
        //     Auth::logout();
        //     return redirect()->route('admin.login')->with('status','You are not authorized to access this page.');
        // }else if ($request->is('user/*')) {
        //     Auth::logout();
        //     return redirect()->route('user.login')->with('status','You are not authorized to access this page.');
        // }
    }
}

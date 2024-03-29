<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // if (session()->has('LoggedUser') && ($request->path() != '/login' && $request->path() != '/register')) {
        //     return redirect('/login')->with('fail', 'You must be login!!');
        // }
        // if (session()->has('LoggedUser') && ($request->path() == '/login' || $request->path() == '/register')) {
        //     return back();
        // }

        if (empty(Session::has('LoggedUser')) && ($request->path() != '/login')) {
            return redirect('/adminlogin')->with('fail', 'You must be login!!');;
        }

        return $next($request);
    }
}
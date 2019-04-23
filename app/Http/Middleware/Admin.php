<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->role->id == 1)
        {
            return $next($request);
        } else {
            return redirect()->route('login')->with('error', 'Heh loe bukan admin nya');
        }
        
        // if(auth()->user()->isAdmin == 1){
        //     return $next($request);
        // }
        // return redirect('home')->with('error', 'Heh loe bukan admin nya');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Addoc
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
        if(auth()->user()->role == 3 OR auth()->user()->role == 5){
            return $next($request);
        }else {
            return redirect('/login')->with('error', 'Unauthorized Page : you need admin permission to access page');
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Active
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
        if(auth()->user()->status == 1){
            return $next($request);
        }else {
            return redirect('/signin')->with('error', 'Your account has been deavtivated, Contact an Admin');
        }
    }
}

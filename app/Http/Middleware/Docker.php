<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Docker
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
        if(auth()->user()->permission->dock == 1){
            return $next($request);
        }else {
            return redirect('/control')->with('error', 'Unauthorized Page : you need admin permission to access page');
        }
    }
}

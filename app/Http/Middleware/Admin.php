<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
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
        if(auth()->user()->role == 5){
            return $next($request);
        }else {
            if(auth()->user()->role == 3){
                //dockmanager page
                return redirect('/control/all/freight')->with('error', 'Unauthorized Page');
            }else if(auth()->user()->role == 1){
                return redirect('/driver/new/delivery')->with('error', 'Unauthorized Page');
            }
            return redirect('/login')->with('error', 'Unauthorized Page : you need admin permission to access page');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InController extends Controller
{

    function weblogin(Request $request)
    {
        $val = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        // $user = Auth::getProvider()->retrieveByCredentials($val);
        // Auth::login($user, $request->get('remember'));

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = auth()->user();

            if($user->role === 1){
                return redirect()->route('driver.driverDashboard');
            }else{
                return redirect()->route('control.dashboard');
            }
        }else {
            return back()->with('error', 'Invalid Login Details');
        }

    }
}

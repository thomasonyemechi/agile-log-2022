<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function login(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required|min:3',
        ])->validate();
        // $user = Auth::getProvider()->retrieveByCredentials($credentials);
        if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return back()->with('error', 'Invalid Credentials');
        }else{
            if(auth()->user()->role == 1){
                return redirect('driver/new/delivery')->with('success', 'Login sucessfull');
             }
             return redirect('control/')->with('success', 'Login sucessfull');
        }

    }


    // function login(Request $request)
    // {
    //     $credentials = Validator::make($request->all(), [
    //         'email' => 'email|required',
    //         'password' => 'required|min:3',
    //     ])->validate();
    //     // $user = Auth::getProvider()->retrieveByCredentials($credentials);
    //     $do = Auth::attempt($credentials);
    //     if($do) {
    //         if(auth()->user()->role == 1){  return redirect('driver/')->with('success', 'Login sucessfull'); }
    //          return redirect('control/')->with('success', 'Login sucessfull'); }else{
    //         return back()->with('error', 'Invalid login details');
    //     }

    // }



}

<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{


    function createPermission()
    {
        $users = User::get();

        foreach($users as $user)
        {
            $this->giveStartPermission($user->id, $user->role);
        }


        return response('done');
    }


    function giveStartPermission($user_id, $role)
    {
        if($role == 5){
            // amdin
            Permission::create([ 'user_id' => $user_id, 'admin' => 1, ]);
        }else if($role == 3){
            // docker
            Permission::create([ 'user_id' => $user_id, 'dock' => 1, ]);
        }else if($role == 1){
            // driver
            Permission::create([ 'user_id' => $user_id ]);
        }else {
            Permission::create([ 'user_id' => $user_id ]);
        }
        return 'done';
    }


    function userStatus(Request $request)
    {
        $user = User::find($request->user_id);
        if(!$user) { abort(404); }
        $msg = ($user->status == 0) ? 'User activated sucessfully' : 'User deactivated sucessfully';
        $state = ($user->status == 0) ? 1 : 0;
        User::where('id', $user->id)->update([
            'status' => $state,
        ]);
        return back()->with('success', $msg);
    }


    function addStaff(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            'name' => 'string|required',
            'email' => 'email|required|unique:users,email',
            'phone' => 'required',
            'role_id' => 'required|integer',
        ])->validate();

        $staff = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role_id,
            'password' => Hash::make($request->phone),
        ]);

        $this->giveStartPermission($staff->id, $request->role);

        return back()->with('success', 'User added sucessfully');

    }
}

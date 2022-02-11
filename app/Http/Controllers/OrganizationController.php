<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class OrganizationController extends Controller
{



    function editOrganizationInfo (Request $request)
    {
        $val = Validator::make($request->all(), [
            'name' => 'string|required',
        ])->validate();
        $org = Organization::find($request->org_id);
        $slug = rand(111,9999).Str::slug($request->name);
        if($request->hasFile('logo')){
            $img = $request->file('logo');
            $extension = $img->getClientOriginalExtension();
            $logo = $slug.'.'.$extension;
            move_uploaded_file($img, 'assets/img/org/'.$logo);
        }
        Organization::where('id', $request->org_id)->update([
            'slug' => $slug,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'logo' => $logo ?? $org->logo,
        ]);
        return redirect('/control/organization/'.$slug)->with('success', 'Update sucessfull');
    }



    function createOrganization(Request $request)
    {
        $val = Validator::make($request->all(), [
            'name' => 'string|required',
        ])->validate();
        $slug = $request->name;
        if($request->hasFile('logo')){
            $img = $request->file('logo');
            $extension = $img->getClientOriginalExtension();
            $logo = $slug.'.'.$extension;
            move_uploaded_file($img, 'assets/img/org/'.$logo);
        }
        Organization::create([
            'slug' => rand(111,9999).Str::slug($slug),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'logo' => $logo ?? '',
            'created_by' => auth()->user()->id
        ]);
        return back()->with('success', 'Organization');
    }
}

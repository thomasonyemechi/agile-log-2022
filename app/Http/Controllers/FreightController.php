<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Freight;
use App\Models\FreightApproval;
use App\Models\Manifest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FreightController extends Controller
{


    function assignFreightToDriver(Request $request)
    {
        $data = json_decode($request->data); $u = 0;
        foreach($data as $fre_id) {
            echo $fre_id.'<br>';
            $fre = Freight::find($fre_id);
            if($fre->status >= 3) {}else {
                $fre->update([
                    'status' => 3,
                    'driver_id' => $request->driver_id,
                    'ofd_time' => time(),
                    'loader' => $request->loader,
                ]);
                $u++;
            }
        }


        return back()->with('success', $u.' freights assigned to driver' );
    }




    function eidtFreight(Request $request)
    {
        $val = Validator::make($request->all(), [
            'pro' => 'required',
            'consignee' => 'required',
            'destination' => 'required',
            'pallet' => 'required',
            'weight' => 'required',
            'byd_split' => 'required',
        ])->validate();

        Freight::where('id',  $request->freight_id)->update([
            'pro' => $request->pro,
            'consignee' => $request->consignee,
            'destination' => $request->destination,
            'pallet' => $request->pallet,
            'weight' => $request->weight,
            'byd_split' => $request->byd_split,
            'spec_ins' => $request->spec_ins,
            'apt' =>  $request->apt ?? 0,
        ]);
        return back()->with('success', 'Freight updated successfully');
    }







    function createFreight(Request $request)
    {

        $val = Validator::make($request->all(), [
            'pro' => 'required',
            'consignee' => 'required',
            'destination' => 'required',
            'pallet' => 'required',
            'weight' => 'required',
            'byd_split' => 'required',
            'org_id' => 'required'
        ])->validate();

        session()->put('org_id', $request->org_id);

        Freight::create([
            'org_id' => $request->org_id,
            'pro' => $request->pro,
            'consignee' => $request->consignee,
            'destination' => $request->destination,
            'pallet' => $request->pallet,
            'weight' => $request->weight,
            'byd_split' => $request->byd_split,
            'spec_ins' => $request->spec_ins,
            'apt' =>  $request->apt ?? 0,
            'user_id' => auth()->user()->id,
            'ctime' => time(),
        ]);
        return back()->with('success', 'Freight added successfully');
    }



}

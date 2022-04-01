<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Freight;
use App\Models\Manifest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class FreightController extends Controller
{

    function adminUpdateFreight(Request $request)
    {
        Validator::make($request->all(), [
            'action' => 'required'
        ]);

        foreach(json_decode($request->data) as $f_id) {
            $fre = Freight::find($f_id);
            $msg = [
                'message' => $request->message,
                'time' => time(),
            ];

            if($fre->message == ''){
                $all_new[] = $msg;
            }else {
                $former_message = json_decode($fre->message, true);
                $former_message[] = $msg;
                $all_new = $former_message;
            }

            $fre->update([
                'message' => json_encode($all_new),
                'status' => $request->action,
            ]);


        }

        return back()->with('success', 'Freights updated sucessfully');
    }


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


        $driver_id = $request->driver_id ?? 0;
        $status = ($driver_id > 0) ? 3 : 0 ;
        $ofd_time = ($driver_id > 0) ? time() : 0 ;

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
            'status' => $status,
            'driver_id' => $driver_id,
            'ofd_time' => $ofd_time,
        ]);
        return back()->with('success', 'Freight added successfully');
    }



    function makeFreightapproval(Request $request){
        $total = $request->total;

        // $arr = ['jpg', 'jpeg', 'gif', 'png'];
        for($i = 0; $i < $total; $i++)
        {
            $freight = Freight::find($_POST['id_'.$i]);
            if($freight->status <= 4) {
                $message = $_POST['message_'.$i];
                $file = $_FILES['file_'.$i];
                $ext = last(explode('.',$file['name']));
                $img_name = $freight->pro.'_'.time().rand(1111111,3333333).'.'.$ext;
                move_uploaded_file($file['tmp_name'], 'assets/img/freight/'.$img_name);

                $time = ($freight->status == 3 || $freight->status == 4) ? time() : $freight->ofd_time;
                $info = [
                    'image' => $img_name,
                    'message' => $message,
                    'time' => time(),
                    'approved_by' => auth()->user()->id
                ];
                $freight->update([
                    'approved' => 1,
                    'approved_info' => json_encode($info),
                    'ofd_time' => $time
                ]);
            }
        }
        return back()->with('success', 'Freights Approved Sucessfully');
    }
}

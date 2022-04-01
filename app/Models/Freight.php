<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freight extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_id', 'pro', 'consignee', 'destination', 'pallet', 'weight', 'byd_split', 'spec_ins', 'apt', 'ctime', 'user_id', 'status', 'driver_id',
        'ofd_time', 'loader', 'message', 'approved', 'approved_info'
    ];

    function org()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }


    function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }


}

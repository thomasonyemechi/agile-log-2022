<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $table = 'organizations';

    protected $fillable = [
        'slug', 'name', 'logo', 'address', 'phone' ,'email' ,'status', 'created_by'
    ];


    function freights()
    {
        return $this->hasMany(Freight::class, 'org_id');
    }
}

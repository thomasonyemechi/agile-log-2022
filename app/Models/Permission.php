<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $fillable = [
        'user_id', 'dock', 'admin', 'super'
    ];

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

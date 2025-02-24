<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'userInfo';

    protected $fillable = [
        'height',
        'weight',
        'user_id'
    ];

    // 1-> N
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
}

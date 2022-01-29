<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'invitable_type',
        'user_to_id',
        'user_from_id',
        'type'
    ];

    protected $with = ['userTo', 'userFrom'];

    public function userTo()
    {
        return $this->belongsTo(User::class, 'user_to_id');
    }

    public function userFrom()
    {
        return $this->belongsTo(User::class, 'user_from_id');
    }

//    public function notifications()
//    {
//        return $this->morphMany('App\Models\Notification', 'notifiable');
//    }
//
//    public function invitable()
//    {
//        return $this->morphTo();
//    }
}

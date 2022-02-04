<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'type'
    ];

    protected $with = ['sender'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'inviteable_type',
        'user_to',
        'user_from',
        'type'
    ];

    public function invitable()
    {
        return $this->morphTo();
    }

    public function userTo()
    {
        return $this->belongsTo(User::class);
    }

    public function userFrom()
    {
        return $this->belongsTo(User::class);
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }
}

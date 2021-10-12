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

    public function invitable()
    {
        return $this->morphTo();
    }
}

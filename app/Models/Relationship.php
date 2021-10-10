<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $fillable = ['user_first_id', 'user_second_id', 'type'];

    public function userFirst()
    {
        return $this->belongsTo(User::class);
    }

    public function userSecond()
    {
        return $this->belongsTo(User::class);
    }
}

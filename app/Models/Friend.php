<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Friend extends Pivot
{
    protected $fillable = ['user_id', 'friend_id', 'status', 'confirmed_at'];
    protected $table = "friends";
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;

}

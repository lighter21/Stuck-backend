<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['imageable_id', 'imageable_type', 'path'];
    public $timestamps = false;
    public $incrementing = false;

    public function getPathAttribute($value)
    {
        return public_path($value);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['imageable_id', 'imageable_type', 'path'];
    public $timestamps = false;
    public $incrementing = false;
    protected $appends = ['parsed_path'];

    public function imageable()
    {
        return $this->morphTo();
}

    //    APPENDS

    public function getParsedPathAttribute()
    {
        return asset('storage/images/' . $this->path);
    }
}

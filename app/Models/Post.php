<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'body'];
    protected $with = ['user', 'comments', 'likes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'user_id', 'post_id')
            ->using(Like::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}

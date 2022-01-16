<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'privacy', 'description'];

    public function Posts()
    {
        return $this->belongsToMany(Post::class, 'group_posts', 'post_id', 'group_id')->using(GroupPost::class);
    }
}

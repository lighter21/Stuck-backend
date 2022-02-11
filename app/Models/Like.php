<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;

class Like extends Pivot
{
    protected $fillable = ['post_id', 'user_id'];
    protected $table = "likes";
    public $timestamps = false;
    public $incrementing = false;

//    public function post()
//    {
//        return $this->belongsTo(Post::class);
//    }
//
//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }
}

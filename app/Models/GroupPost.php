<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupPost extends Pivot
{
    protected $fillable = ['post_id', 'group_id'];
    protected $table = "group_posts";
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'privacy', 'description'];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'group_posts', 'post_id', 'group_id')
            ->using(GroupPost::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_members', 'group_id', 'user_id')
            ->using(GroupMember::class);
    }
}

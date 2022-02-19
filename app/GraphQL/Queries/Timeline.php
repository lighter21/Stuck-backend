<?php

namespace App\GraphQL\Queries;

use App\Models\Post;
use App\Models\User;

class Timeline
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::find($args['user_id']);
        $postIds = $user->friends->pluck('id')->toArray();
        array_push($postIds, $user->id);

        return Post::whereIn('user_id', $postIds)->latest()->get();
    }
}

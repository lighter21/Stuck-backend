<?php

namespace App\GraphQL\Queries;

use App\Models\Post;
use App\Models\User;

class Timeline
{
    /**
     * @param null $_
     * @param array<string, mixed> $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::find($args['user_id']);
        $friendsIds = $user->friends->pluck('id')->toArray();
        $groupIds = $user->groups->pluck('id')->toArray();
        array_push($friendsIds, $user->id);


        $friendsPosts = Post::whereIn('user_id', $friendsIds)->with(['comments', 'groups', 'likes', 'user', 'image'])->whereDoesntHave("groups")->latest()->get();
        $postsFromGroups = Post::whereHas('groups', function ($query) use ($groupIds) {
            return $query->whereIn('id', $groupIds);
        })->with(['comments', 'groups', 'likes', 'user', 'image'])->latest()->get();


        $collection = $friendsPosts->merge($postsFromGroups);

        return $collection;
    }
}

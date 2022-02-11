<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;

class ToggleLike
{
    /**
     * @param null $_
     * @param array<string, mixed> $args
     */
    public function __invoke($_, array $args)
    {
        $post = Post::find($args['post_id']);

        if ($post->likes()->where('user_id', $args['user_id'])->exists())
            $post->likes()->detach($args['user_id']);
        else
            $post->likes()->attach($args['user_id']);

        return $post;

    }
}

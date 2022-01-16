<?php

namespace App\GraphQL\Mutations;

use App\Models\GroupPost;

class AttachPostToGroup
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        return GroupPost::create([
            'group_id' => $args['group_id'],
            'post_id' => $args['post_id']
        ]);
    }
}

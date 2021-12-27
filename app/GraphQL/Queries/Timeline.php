<?php

namespace App\GraphQL\Queries;

use App\Models\Post;

class Timeline
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
//       TODO: Dodać filtrowanie po znajomych
        return Post::latest()->get();
    }
}

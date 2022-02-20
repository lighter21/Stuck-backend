<?php

namespace App\GraphQL\Queries;

use App\Models\User;

class ImagesGallery
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::where('username', $args['username'])->firstOrFail();
        return $user->posts()->whereHas('image')->get()->pluck('image');
    }
}

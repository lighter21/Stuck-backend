<?php

namespace App\GraphQL\Queries;

use App\Models\Image;
use App\Models\User;

class ImagesGallery
{
    /**
     * @param null $_
     * @param array<string, mixed> $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::where('username', $args['username'])->firstOrFail();
        $postIds = $user->posts->pluck('id')->toArray();

        return Image::where(['imageable_type' => 'App\Models\User', 'imageable_id' => $user->id])->orWhere(function ($query) use ($postIds) {
            $query->where('imageable_type', 'App\Models\Post')->whereIn('imageable_id', $postIds);
        })->get();
    }
}

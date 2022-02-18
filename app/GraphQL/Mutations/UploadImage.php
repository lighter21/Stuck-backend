<?php

namespace App\GraphQL\Mutations;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class UploadImage
{
    /**
     * @param null $_
     * @param array<string, mixed> $args
     */
    public function __invoke($_, array $args)
    {
        /** @var \Illuminate\Http\UploadedFile $file */
        $file = $args['file'];
        $fileName = uniqid(rand(), true) . "." . $file->extension();
        $file->storePubliclyAs('images', $fileName);

        $image = Image::create([
            'imageable_id' => $args['id'],
            'imageable_type' => $args['type'],
            'path' => $fileName
        ]);

        return $image;
    }
}

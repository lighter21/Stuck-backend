<?php

namespace App\GraphQL\Mutations;

use App\Models\Image;
use App\Models\User;

class UploadImages
{
    /**
     * @param null $_
     * @param array<string, mixed> $args
     */
    public function __invoke($_, array $args)
    {
        /** @var \Illuminate\Http\UploadedFile $file */
        $files = $args;
        $fileNames = [];
        dd($files);

        foreach ($files as $file) {
            $fileName = $file->storePubliclyAs($file, sha1_file($file->getFilename()));
            array_push($fileNames, ['path' => $fileName]);
            Image::create([
                'imageable_id' => $args['id'],
                'imageable_type' => $args['type'],
                'path' => $fileName
            ]);

        }

        return $fileNames;
    }
}

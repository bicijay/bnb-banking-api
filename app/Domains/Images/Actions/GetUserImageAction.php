<?php


namespace App\Domains\Images\Actions;


use App\Domains\Images\Models\Image;
use Illuminate\Validation\UnauthorizedException;

class GetUserImageAction
{
    public function execute(int $userId, int $imageId): Image
    {
        $image = Image::find($imageId);

        if (!$image || $image->user_id !== $userId) {
            throw new UnauthorizedException();
        }

        return $image;
    }
}

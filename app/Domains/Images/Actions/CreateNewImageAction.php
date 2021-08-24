<?php


namespace App\Domains\Images\Actions;


use App\Domains\Images\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CreateNewImageAction
{
    public function execute(UploadedFile $image, int $userId): Image
    {
        $filename = time() . "-" . $image->getClientOriginalName();
        $path = "public/images/{$userId}/{$filename}";

        Storage::put($path, $image->get());

        return Image::create([
            "filename" => $filename,
            "extension" => $image->getClientOriginalExtension(),
            "bytes" => $image->getSize(),
            "filesystem" => config("filesystems.default"),
            "path" => $path,
            "user_id" => $userId
        ]);
    }
}

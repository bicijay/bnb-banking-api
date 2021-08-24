<?php


namespace App\Http\Controllers\Admin;


use App\Domains\Images\Models\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminImageController extends Controller
{
    public function find($imageId): BinaryFileResponse
    {
        $image = Image::find($imageId);
        return response()->file(Storage::path($image->path));
    }
}

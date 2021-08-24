<?php


namespace App\Http\Controllers\Customer;


use App\Domains\Images\Actions\GetUserImageAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function find(int $imageId, GetUserImageAction $getUserImageAction)
    {
        $image = $getUserImageAction->execute(Auth::id(), $imageId);
        return response()->file(Storage::path($image->path));
    }
}

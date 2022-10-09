<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public static function upload(object $image = null)
    {
        $time = time();
        $file = $image;
        $AddedName =  $time . '-' . $file->getClientOriginalName();
        $image = Storage::putFileAs('images', $file, $AddedName);

        return [
            'image' => env('APP_URL') . '/' . $image
        ];
    }
}

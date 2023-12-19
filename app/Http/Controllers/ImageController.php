<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    //

    public function view(Request $request)
    {
        // Something like (not sure)
        $image = Storage::get($request->url);

        return response()->make($image, 200, ['content-type' => 'image/jpg']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    //

    public function show($slug)
    {
        // Something like (not sure)
        $image = File::get('images/' . $slug . '.jpg');

        return response()->make($image, 200, ['content-type' => 'image/jpg']);
    }
}

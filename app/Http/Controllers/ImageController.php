<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index(Image $image)
    {

    }

    public function store(Request $request)
    {

        $images_arr = $request->images;

        foreach ($images_arr as $image){
            $images = new Image();
            $images->album_id = $request->input('album_id');
            $images->name = uploadImage($image,'images');
            $images->save();

        }
        return redirect()->back();
   }

}

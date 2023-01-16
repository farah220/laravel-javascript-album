<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::all();

        return view('web.index',compact('albums'));
    }
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'image' => ['image','required'],
        ]);
        $attributes['image'] = uploadImage($request->file('image'),'albums');
        $attributes['user_id'] = auth()->id();
        Album::create($attributes);

    }

    public function show(Album $album)
    {
        return view('album.index',compact('album'));

    }

    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->back();
    }
}

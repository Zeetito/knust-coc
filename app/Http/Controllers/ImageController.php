<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    //
    public function store(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'imageable_type' => 'required|string',
        'imageable_id' => 'required|integer',
    ]);

    $image = $request->file('image');
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    Storage::put('public/images/' . $imageName, file_get_contents($image));

    $photo = Image::create([
        'url' => $imageName,
        'imageable_type' => $request->input('imageable_type'),
        'imageable_id' => $request->input('imageable_id'),
    ]);

    return redirect()->back()->with('success','Image Upload Success.');
    // return response()->json($photo, 201);
}
}

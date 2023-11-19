<?php

namespace App\Http\Controllers;

use App\Models\DefaultImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DefaultImageController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'defaultImageable_type' => 'required|string',
            'defaultImageable_id' => 'required|integer',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        Storage::put('public/images/' . $imageName, file_get_contents($image));

        $photo = DefaultImage::create([
            'url' => $imageName,
            'defaultImageable_type' => $request->input('defaultImageable_type'),
            'defaultImageable_id' => $request->input('defaultImageable_id'),
        ]);

        return redirect()->back()->with('success','Image Upload Success.');
        // return response()->json($photo, 201);
    }
}


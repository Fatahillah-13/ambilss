<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Capture;

class WebcamController extends Controller
{
    // public function store(Request $request)
    // {
    //     $image = $request->input('image'); // Base64 image data
    //     $image = str_replace('data:image/png;base64,', '', $image);
    //     $image = str_replace(' ', '+', $image);
    //     $imageName = 'webcam_' . time() . '.png';

    //     file_put_contents(public_path('storage/' . $imageName), base64_decode($image));

    //     return response()->json(['message' => 'Image saved successfully!', 'file' => $imageName]);
    // }

    public function store(Request $request)
    {
        $image = $request->input('image'); // Ambil data gambar dari request
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'pic_' . time() . '.jpeg';

        file_put_contents(public_path('storage/' . $imageName), base64_decode($image));

        // Simpan data ke database
        $capture = new Capture();
        $capture->name = $request->input('name');
        $capture->class = $request->input('class');
        $capture->image = $imageName;
        $capture->save();

        return response()->json(['message' => 'Image saved successfully']);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotoUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            "photo" => "required|image"
        ]);

        $path = $request->file("photo")->store("photos","public");

        User::where("id",Auth::id())->update([
            "photo" => $path
        ]);

        return redirect()->back()->with("message","Photo Uploaded Successfully.");
    }
}

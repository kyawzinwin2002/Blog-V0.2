<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SuspendController extends Controller
{
    public function active(Request $request)
    {
        User::where("id",$request->id)->update([
            "suspended" => "0"
        ]);

        return redirect()->back()->with("message","Activated User Successfully.");
    }

    public function ban(Request $request)
    {
        User::where("id",$request->id)->update([
            "suspended" => "1"
        ]);

        return redirect()->back()->with("message","Ban User Successfully.");
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function changePass()
    {
        return view("auth.changePass");
    }

    public function check(Request $request)
    {
        $request->validate([
            "current_password" => "required|min:8",
            "password" => "required|min:8|confirmed"
        ]);

        if(!Hash::check($request->current_password,Auth::user()->password))
        {
            return redirect()->back()->withErrors(["current_password" => "Password is wrong!"]);
        }

        User::where("id",Auth::id())->update([
            "password" => Hash::make($request->password)
        ]);

        Auth::logout();

        return redirect()->route("login")->with("message","Changed Password Successfully.Login with your new password.");

    }
}

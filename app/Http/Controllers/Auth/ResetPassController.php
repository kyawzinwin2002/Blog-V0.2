<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPassController extends Controller
{
    public function forgetPassword()
    {
        return view("auth.forget");
    }

    public function checkEmail(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:users,email"
        ], ["email.exists" => "Something went wrong!"]);

        $user = User::where("email", $request->email)->first();

        $key = md5($user->id . $user->user_token . config('app.key'));

        logger("Your reset password link is " . route("password.reset", ["user_token" => $user->user_token, "key" => $key]));

        return redirect()->route("login")->with("message", "Password reset link is sent!");
    }

    public function showResetUi(Request $request)
    {
        if ($request->has("user_token") && $request->has("key")) {
            $user_token = $request->get("user_token");

            $user = User::where("user_token", $user_token)->first();

            if ($user && $request->get("key") === $this->generateKey($user)){

                return view("auth.resetPass", compact("user_token"));

            }
        }

        return abort(403);
    }

    private function generateKey(User $user)
    {
        return md5($user->id . $user->user_token . config('app.key'));
    }

    public function reset(Request $request)
    {
        $request->validate([
            "user_token" => "required|string|exists:users,user_token",
            "password" => "required|min:8|confirmed"
        ]);

        $user_token = md5(rand(111111, 999999));

        User::where("user_token", $request->user_token)->update([
            "password" => Hash::make($request->password),
            "user_token" => $user_token
        ]);

        return redirect()->route("login")->with("message", "Reset Password Successfully!");
    }
}

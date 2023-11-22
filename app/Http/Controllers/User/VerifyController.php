<?php

namespace App\Http\Controllers\User;

use App\Enums\CodeType;
use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyController extends Controller
{
    public function verify()
    {
        return view("Users.verify");
    }

    public function check(Request $request)
    {
        $user = User::find(Auth::id());

        $code = Code::where("user_id", $user->id)->first();

        if ($code->code == $request->get("verify_code") && !$code->is_used && $code->expires_at >= now()  && CodeType::tryFrom($code->type) == CodeType::Register )
        {
            $user->email_verified_at = now();
            $user->update();

            $code->is_used = true;
            $code->update();

            return redirect()->route("users.profile")->with("message", "Verified Successfully");
        }

        return redirect()->back()->withErrors(["verify_code" => "Something Went Wrong!"]);
    }
}

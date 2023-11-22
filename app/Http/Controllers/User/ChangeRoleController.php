<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangeRoleController extends Controller
{
    public function changeRole(Request $request)
    {
        $user = new User();
        $this->authorize("changeRole",[User::class,$user]);

        $user_id = $request->id;
        $role_id = $request->role_id;
        
        $user = User::where("id",$user_id)->update([
            "role_id" => $role_id
        ]);

        return redirect()->back()->with("message","Changed User'role Successfully.");
    }
}

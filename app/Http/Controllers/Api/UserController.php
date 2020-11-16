<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->email;
        $password = bcrypt($request->password);
        $user = User::where('email', $username)->where('password', $password)->first();
        if ($user) {
            $token = Hash::make($request->password);
            $user->api_token = $token;
            $user->save();
            return response()->json(['token' => $token], 200);
        }
        return response()->json(['status' => 'Email or Password is Wrong'], 403);
    } //end of the login method

}//end of the UserController class

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = Str::random(80);
            Auth::user()->api_token = $token;
            
            Auth::user()->save();
            return response()->json(['token' => $token], 200);
        }
        return response()->json(['status' => 'Email or Password is Wrong'], 403);
    } //end of the login method

}//end of the UserController class

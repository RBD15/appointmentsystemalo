<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    
    public function login(Request $request){
        $this->validateLogin($request);
        if(Auth::attempt($request->only('email','password'))){
            return response()->json([
                'message'=>'Authenticated',
                'token'=>$request->user()->createToken($request->email)->plainTextToken,
            ],200);
        }
        return response()->json([
            'message'=>'Unauthenticated',
            'token'=>'',
        ],401);
    }

    public function validateLogin(Request $request)
    {
        return $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
    }


}

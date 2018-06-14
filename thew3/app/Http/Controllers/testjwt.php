<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class testjwt extends Controller
{
    public function generateAuthToken(Request $request){
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid Credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Something went wrong please try again.'], 500);
        }

        return response()->json(compact('token'));
    }

}

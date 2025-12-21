<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login']]);
    }
    public function login (){
        $credential = request(['email','password']);
        if(!$token= auth()->attemp($credential)){
            return response()->json(['errors'=>'Authorized'],401);
        }
        return $this->respondWithToken($token);
    }
    protected function respondWithToken($token)
    {
        return response()->json(
            [
                'access_token'=>$token,
                'token_type'=>'bearer',
                'expires_in'=> auth()->factory()->getTTL()*60,
            ]
        );
    }
}
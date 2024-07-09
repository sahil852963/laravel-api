<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Authcontroller extends Controller
{
    public function signUp(Request $req){
        $validateUser = Validator::make(
            $req->all(),
            [
                'name' =>'required',
                'email' =>'required|email|unique:users,email',
                'password' =>'required',
            ]
        );
        if($validateUser->fails()){
            return response()->json([
                'status' =>false,
                'message' =>'Validation error',
                'errors' => $validateUser->errors()->all(),
            ], 401);
        }

        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => $req->password
        ]);
        return response()->json([
            'status' =>true,
            'message' =>'User Created Successfully!',
            'users' => $user,
        ], 200);
    }
    public function login(Request $req){
        $validateUser = Validator::make(
            $req->all(),
            [
                'email' =>'required|email',
                'password' =>'required',
            ]
        );
        if($validateUser->fails()){
            return response()->json([
                'status' =>false,
                'message' =>'Authentication Failed!',
                'errors' => $validateUser->errors()->all(),
            ], 404);
        }
        if(Auth::attempt(['email' => $req->email, 'password' => $req->password])){
            $authUser = Auth::user();
            return response()->json([
                'status' =>true,
                'message' =>'User Created Successfully!',
                'token' => $authUser->createToken("API TOKEN")->plainTextToken,
                'token_type' => 'bearer'
            ], 200);
        } else {
            return response()->json([
                'status' =>false,
                'message' =>'Validation Failed!',
            ], 401);
        }
    }
    public function logOut(Request $req){
        $user = $req->user();
        $user->tokens()->delete();
        return response()->json([
            'status' =>true,
            'message' =>'User LogOut Successfully!',
        ], 200);
    }
}

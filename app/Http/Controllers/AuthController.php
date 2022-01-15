<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Feacdes\Hash;
use App\User;


class AuthController extends Controller
{
    public function register(Request $request){
        $field = $request->validate([
            "name"=>"required|string",
            "password"=>"required|string|confirmed",
            "email"=>"string|required|email|unique:users"
        ]);

        $user = User::create([
            'name' => $field['name'],
            'email' => $field['email'],
            'password' =>bcrypt($field['password']) 
    
        ]);
        $token = $user->CreateToken("myToken")->plainTextToken;
        $response = [
            'user'=>$user,
            'myToken'=>$token
        ];
        return $response;
    }
    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return[
            "message"=>"Logged Out"
        ];      
    }

    public function login(Request $request){
        $field = $request->validate([
            "password"=>"required|string",
            "email"=>"string|required|email"
        ]);

        $user = User::where('email' , $field['email'])->first(); //check email
        $pass = Hash::check($feild['password'], $user->password);
        if(!$user || !$pass){
            return response([
                "message"=>"bad login"
            ], 401);
        }
        $token = $user->CreateToken("myToken")->plainTextToken;
        $response = [
            'user'=>$user,
            'myToken'=>$token
        ];
        return $response;
    }

   
}

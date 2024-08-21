<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
            'name' => ['required', 'string']
        ]);

        $user = User::create($data); 
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user'=>$user,
            'token'=>$token
        ];
    }

    public function login(Request $request){
        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required', 'min:6']
        ]);

        $user = User::where('email', $data['email'])->first();

        if(!$user || !Hash::check($data['password'], $user->password)){
            return response(
                ['massage' => 'bad creds'], 401
            );
        }else{
            $token = $user->createToken('auth_token')->plainTextToken;
            return [
                'name'=>$user->name,
                'email'=>$user->email,
                'token'=>$token
            ];
        }

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
    ];

    public function register(Request $request)
    {
        $this->validate($request, $this->rules);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password)
        ]);

        $token = $user->createToken('token')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    public function login(Request $request)
    {

    }

}

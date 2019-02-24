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

    public function registerUser(Request $request, User $userModel)
    {
        $user = $userModel->createUser(
            $request->post('email'),
            Hash::make($request->post('password')),
            $request->post('name'),
            $request->post('image')
        );
        return response()->json($user, 201);
    }

    public function loginUser(Request $request, User $userModel)
    {
        $user = $userModel->getByEmail($request->post('email'));
        return response()->json($user, 200);
    }
}

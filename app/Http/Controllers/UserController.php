<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        User::createUser($request->email, $request->password, $request->name);
        return response()->json([
            'message' => 'User '. $request->name .' successfully create!'
        ], 201);
    }

    public function getById(Request $request)
    {
        $user = User::getById($request->id);
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'user_id' => $user->id
        ], 200);
    }
}

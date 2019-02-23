<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    public function createUser(Request $request, User $user)
    {
        $user->createUser($request->post('email'), $request->post('password'), $request->post('name'));
        return response()->json([
            'message' => 'User '. $request->post('name') .' successfully create!'
        ], 201);
    }

    public function getById(Request $request, User $user)
    {
        $user = $user->getById($request->post('id'));
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'user_id' => $user->id
        ], 200);
    }
}

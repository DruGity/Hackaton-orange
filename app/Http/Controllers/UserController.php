<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createUser(Request $request, User $user)
    {
        $user->createUser(
            $request->post('email'),
            Hash::make($request->post('password')),
            $request->post('name'),
            $request->post('image')
        );
        return response()->json($user, 201);
    }

    public function getById(Request $request, User $userModel)
    {
        $user = $userModel->getById($request->post('id'));
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'user_id' => $user->id
        ], 200);
    }
}

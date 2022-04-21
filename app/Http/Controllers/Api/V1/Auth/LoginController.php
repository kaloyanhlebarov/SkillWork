<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!$user) {
            throw ValidationException::withMessages([
                'email' => ['There is no such user.'],
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['The password is wrong. Try agin!'],
            ]);
        }

        $user->createApiToken();

        return response()->json([
            'user' => UserResource::make($user),
            'token_data' => [
            	'access_token' => $user->public_api_token,
            ],
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->deleteApiToken();

        return response()->json([], 200);
    }
}

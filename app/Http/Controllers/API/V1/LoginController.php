<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\V1\LoginRequest;
use App\Http\Resources\API\V1\UserResource;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(LoginRequest $request)
    {
        $token = Auth::attempt($request->validated());

        if (!$token) {
            return response()->json([
                'message' => 'Incorrect email or password.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = Auth::user();

        return response()->json([
            'user' => UserResource::make($user),
            'authorization' => [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        ], Response::HTTP_OK);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Disconnected.',
        ], Response::HTTP_OK);
    }
}   

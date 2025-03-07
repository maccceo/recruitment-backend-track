<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\User\StoreUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(StoreUserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());
        $token = $this->userService->generateToken($user);
        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 201);
    }

    public function login(AuthLoginRequest $request)
    {
        if (!$this->userService->isValidUser($request['email'], $request['password'])) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = User::where('email', $request['email'])->first();
        $token = $this->userService->generateToken($user);
        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        $this->userService->destroyToken($request);
        return response()->json([
            'message' => 'Logout successful'
        ]);
    }
}

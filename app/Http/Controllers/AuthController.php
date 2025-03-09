<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;

class AuthController extends BaseController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Creates a new user account and returns an access token.
     */
    public function register(StoreUserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());
        $token = $this->userService->generateToken($user);
        return response()->json([
            'user' => new UserResource($user),
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 201);
    }

    /**
     * Logs in a user by validating their credentials and returning an access token.
     */
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
            'user' => new UserResource($user),
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Logs out the authenticated user by invalidating their access token.
     */
    public function logout(Request $request)
    {
        $this->userService->destroyToken($request);
        return response()->json([
            'message' => 'Logout successful'
        ]);
    }
}

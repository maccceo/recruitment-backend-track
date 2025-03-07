<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function createUser(array $userData): User
    {
        return User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => bcrypt($userData['password']),
        ]);
    }

    public function updateUser(User $user, array $userData): User
    {
        if (isset($userData['password'])) {
            $userData['password'] = bcrypt($userData['password']);
        }
        $user->update($userData);
        return $user->refresh();
    }

    public function deleteUser(User $user): void
    {
        $user->delete();
    }

    public function isValidUser(string $email, string $password): bool
    {
        return Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);
    }

    public function generateToken(User $user): string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }

    public function destroyToken(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
    }
}

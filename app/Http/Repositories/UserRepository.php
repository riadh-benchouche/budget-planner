<?php

namespace App\Http\Repositories;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    /**
     * @param array $data
     * @return mixed
     */
    public function createAccount(array $data): mixed
    {
        return User::create([
            'email' => $data['email'],
            'password' => $data['password'],
            'name' => $data['name']
        ])->assignRole(Roles::USER->value);
    }

    /**
     * @param User $user
     * @return string
     */
    public function createToken(User $user): string
    {
        return $user->createToken($user->email)->plainTextToken;
    }


    public function revokeTokenById(User $user, int $tokenId): void
    {
        $user->tokens()->where('id', $tokenId)->delete();
    }
}

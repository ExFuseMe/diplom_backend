<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    public function loginUser(array $validated)
    {
        if (!auth()->attempt($validated)) {
            return false;
        }

        return User::where('email', $validated['email'])->first();
    }
}

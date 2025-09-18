<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(LoginRequest $request, AuthService $authService)
    {
        $validated = $request->validated();

        $user = $authService->loginUser($validated);
        if ($user instanceof User){
            return new LoginResource($user);
        }
        throw new ValidationException('Неправильный логин/пароль');
    }
}

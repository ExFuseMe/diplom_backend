<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(LoginRequest $request, AuthService $authService): LoginResource
    {
        $validated = $request->validated();

        $user = $authService->loginUser($validated);
        if ($user instanceof User) {
            return new LoginResource($user);
        }

        throw ValidationException::withMessages(['error' => __('auth.failed')]);
    }

    public function me(AuthService $authService): UserResource
    {
        $user = $authService->getUserInstance();

        return new UserResource($user);
    }

    public function logout(): Response
    {
        auth()->user()->tokens()->delete();

        return response()->noContent();
    }
}

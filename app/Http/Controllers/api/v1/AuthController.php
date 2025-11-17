<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
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

    public function register(RegisterRequest $request, AuthService $authService): LoginResource
    {
        $validated = $request->validated();

        $data = $authService->registerUser($validated);

        if ($data instanceof User) {
            DB::commit();
            return new LoginResource($data);
        }
        throw ValidationException::withMessages(['error' => __('http-statuses.0')]);

    }

    public function verifyEmail(VerifyEmailRequest $request, AuthService $authService): LoginResource
    {
        $validated = $request->validated();

        $isVerified = $authService->verifyEmail($validated);

        if (!$isVerified) {
            throw ValidationException::withMessages(['error' => __('passwords.token')]);
        }
        return new LoginResource($isVerified);
    }
}

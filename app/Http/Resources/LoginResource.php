<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $user = $this->resource;
        $token = $user->createToken('auth_token')->plainTextToken;
        return [
            'token' => $token,
            'user' => new UserResource($user),
        ];
    }
}

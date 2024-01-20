<?php

namespace App\Http\Traits;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

trait JwtAuthTrait
{
    protected function generateToken(array $credentials): ?string
    {
        return Auth::guard('api')->attempt($credentials);
    }

    protected function refreshToken(): ?string
    {
        return Auth::guard('api')->refresh();
    }

    protected function getUser(): ?Authenticatable
    {
        return Auth::guard('api')->user();
    }

    protected function userLogout(): void
    {
        Auth::guard('api')->logout();
    }

    public function responseWithToken($user, $token, $message): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'user' => $user,
            'authorization' => [
                'access_token' => $token,
                'type' => 'bearer',
            ],
        ]);
    }

    protected function unauthorizedResponse(): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized'
        ], 401);
    }
}

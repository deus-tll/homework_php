<?php

namespace App\Http\Controllers\Auth\Jwt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Traits\JwtAuthTrait;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    use JwtAuthTrait;

    public function login(LoginRequest $request): JsonResponse
    {
        $token = $this->generateToken($request->validated());

        if (!$token) {
            return $this->unauthorizedResponse();
        }

        $user = $this->getUser();

        return $this->responseWithToken($user, $token, 'User logged in successfully');
    }
}

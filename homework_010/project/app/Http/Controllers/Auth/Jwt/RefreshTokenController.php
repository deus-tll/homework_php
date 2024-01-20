<?php

namespace App\Http\Controllers\Auth\Jwt;

use App\Http\Controllers\Controller;
use App\Http\Traits\JwtAuthTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RefreshTokenController extends Controller
{
    use JwtAuthTrait;

    public function refresh(): JsonResponse
    {
        $user = $this->getUser();

        $token = $this->refreshToken();

        return $this->responseWithToken($user, $token, 'Token refreshed');
    }
}

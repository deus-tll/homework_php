<?php

namespace App\Http\Controllers\Auth\Jwt;

use App\Http\Controllers\Controller;
use App\Http\Traits\JwtAuthTrait;
use Illuminate\Http\JsonResponse;

class LogoutController extends Controller
{
    use JwtAuthTrait;

    public function logout(): JsonResponse
    {
        $this->userLogout();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out'
        ]);
    }
}

<?php

namespace App\Http\Controllers\Auth\Jwt;

use App\Http\Controllers\Controller;
use App\Http\Traits\JwtAuthTrait;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    use JwtAuthTrait;

    public function profile(): JsonResponse
    {
        $user = $this->getUser();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile data',
            'user' => $user
        ]);
    }
}

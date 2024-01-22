<?php

namespace App\Http\Controllers\Auth\Jwt;

use App\Customs\Services\EmailVerificationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Traits\JwtAuthTrait;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    use JwtAuthTrait;

    public function __construct(private readonly EmailVerificationService $service){}

    public function register(RegisterRequest $request): JsonResponse
    {
        $createdUser = User::query()->create($request->validated());

        $this->service->sendVerificationLink($createdUser);
        $token = $this->generateToken($request->only('email', 'password'));

        return $this->responseWithToken($createdUser, $token, 'User created successfully');
    }
}

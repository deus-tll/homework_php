<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResendEmailVerificationLinkRequest;
use App\Http\Requests\Auth\VerifyEmailRequest;
use App\Services\EmailVerificationService;
use Illuminate\Http\JsonResponse;

class VerifyUserEmailController extends Controller
{
    public function __construct(private readonly EmailVerificationService $service){}

    public function verifyUserEmail(VerifyEmailRequest $request): ?JsonResponse
    {
        return $this->service->verifyEmail($request->email, $request->token);
    }

    public function resendEmailVerificationLink(ResendEmailVerificationLinkRequest $request): ?JsonResponse
    {
        return $this->service->resendLink($request->email);
    }
}

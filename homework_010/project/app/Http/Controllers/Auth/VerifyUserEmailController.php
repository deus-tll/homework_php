<?php

namespace App\Http\Controllers\Auth;

use App\Customs\Services\EmailVerificationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResendEmailVerificationLinkRequest;
use App\Http\Requests\Auth\VerifyEmailRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

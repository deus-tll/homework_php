<?php

namespace App\Customs\Services;

use App\Models\EmailVerificationToken;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class EmailVerificationService
{
    /**
     * Generate verification link
     */
    public function generateVerificationLink(string $email): ?string
    {
        $checkIfTokenExists = EmailVerificationToken::query()->where('email', $email)->first();
        $checkIfTokenExists?->delete();

        $token = Str::uuid();
        $url = config('app.url'). '?token=' .$token . '&email='.$email;

        $saveToken = EmailVerificationToken::query()->create([
            'email' => $email,
            'token' => $token,
            'expired_at' => now()->addMinutes(10)
        ]);

        return $saveToken ? $url : null;
    }


    /**
     * Send verification link to a user
     */
    public function sendVerificationLink(object $user): void
    {
        Notification::send($user, new EmailVerificationNotification($this->generateVerificationLink($user->email)));
    }


    /**
     * Verify email
     */
    public function verifyEmail(string $email, string $token)
    {
        $user = User::query()->where('email', $email)->first();
        if (!$user) {
            response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ])->send();
            exit;
        }
        $this->checkIfEmailIsVerified($user);
        $verifiedToken = $this->verifyToken($email, $token);

        if ($user->markEmailAsVerified()) {
            $verifiedToken->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Email has been verified successfully'
            ]);
        }
        else {
            return response()->json([
                'status' => 'error',
                'message' => 'Verification failed, please try again later.'
            ]);
        }
    }


    /**
     * Check if user has already been verified
     */
    public function checkIfEmailIsVerified(object $user): void
    {
        if ($user->email_verified_at) {
            response()->json([
                'status' => 'error',
                'message' => 'Email has already been verified'
            ])->send();
            exit;
        }
    }


    /**
     * Verify token
     */
    public function verifyToken(string $email, string $token)
    {
        $foundToken = EmailVerificationToken::query()->where('email', $email)->where('token', $token)->first();

        if ($foundToken) {
            if ($foundToken->expired_at >= now()) {
                return $foundToken;
            }
            else {
                $foundToken->delete();
                response()->json([
                    'status' => 'error',
                    'message' => 'Token expired'
                ])->send();
                exit;
            }
        }
        else {
            response()->json([
                'status' => 'error',
                'message' => 'Invalid token'
            ])->send();
            exit;
        }
    }


    /**
     * Resend link with token
     */
    public function resendLink(string $email): JsonResponse
    {
        $user = User::query()->where('email', $email)->first();

        if ($user) {
            $this->sendVerificationLink($user);
            return response()->json([
                'status' => 'success',
                'message' => 'Verification link sent successfully'
            ]);
        }
        else {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ]);
        }
    }
}

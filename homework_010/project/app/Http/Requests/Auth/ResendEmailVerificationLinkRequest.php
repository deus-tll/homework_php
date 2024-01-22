<?php

namespace App\Http\Requests\Auth;

use App\Http\Traits\AuthorizationTrait;
use App\Http\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class ResendEmailVerificationLinkRequest extends FormRequest
{
    use AuthorizationTrait;
    use ValidationTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
        ];
    }
}

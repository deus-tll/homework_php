<?php

namespace App\Http\Traits;

trait AuthorizationTrait
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}

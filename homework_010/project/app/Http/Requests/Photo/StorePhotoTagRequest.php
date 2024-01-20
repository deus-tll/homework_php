<?php

namespace App\Http\Requests\Photo;

use App\Http\Traits\AuthorizationTrait;
use App\Http\Traits\ValidationTrait;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePhotoTagRequest extends FormRequest
{
    use ValidationTrait;
    use AuthorizationTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:photo_tags,name|min:3|max:256',
            'slug' => 'required|string|unique:photo_tags,slug|min:3|max:64',
        ];
    }
}

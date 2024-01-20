<?php

namespace App\Http\Requests\Photo;

use App\Http\Traits\AuthorizationTrait;
use App\Http\Traits\ValidationTrait;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePhotoRequest extends FormRequest
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
            'name' => 'string|min:3|max:64',
            'description' => 'nullable|string|min:0|max:200',
            'place' => 'nullable|string|min:0|max:32',
            'tags' => 'array',
            'tags.*' => 'exists:photo_tags,id',
            'category_id' => 'exists:photo_categories,id',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:8096'
        ];
    }
}

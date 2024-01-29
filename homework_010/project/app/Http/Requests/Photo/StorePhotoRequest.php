<?php

namespace App\Http\Requests\Photo;

use App\Http\Traits\AuthorizationTrait;
use App\Http\Traits\ValidationTrait;
use App\Models\Photo\Photo;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePhotoRequest extends FormRequest
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
            'name' => 'required|string|unique:photos,name|min:3|max:64',
            'description' => 'nullable|string|min:0|max:200',
            'place' => 'nullable|string|min:0|max:32',
            'tags' => 'array',
            'tags.*' => 'exists:photo_tags,id',
            'category_id' => 'required|exists:photo_categories,id',
            'photo' => 'required|file|mimes:jpeg,png,jpg,gif,webp|max:8096'
        ];
    }

    public function getModelFromRequest() : Photo
    {
        return new Photo($this->all());
    }
}

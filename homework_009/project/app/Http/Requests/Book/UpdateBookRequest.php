<?php

namespace App\Http\Requests\Book;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|min:1|max:100',
            'description' => 'nullable|string|min:0|max:600',
            'author' => 'string|min:1|max:75',
            'page_count' => 'nullable|integer',
            'year' => 'nullable|integer',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new JsonResponse(['errors' => $validator->errors()], 422);

        throw new ValidationException($validator, $response);
    }

    public function updateModel(Book $book): Book
    {
        $book->update($this->all());
        return $book;
    }
}

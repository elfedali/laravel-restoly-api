<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'reviewable_id' => ['required', 'max:255'],
            'reviewable_type' => ['required', 'max:255', 'string'],
            'content' => ['required', 'max:255', 'string'],
            'rating' => ['nullable', 'max:255'],
        ];
    }
}

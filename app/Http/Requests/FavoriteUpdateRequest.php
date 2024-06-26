<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FavoriteUpdateRequest extends FormRequest
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
            'favoritable_id' => ['required', 'max:255'],
            'favoritable_type' => ['required', 'max:255', 'string'],
        ];
    }
}

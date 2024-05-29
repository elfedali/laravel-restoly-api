<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuItemStoreRequest extends FormRequest
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
            'menu_id' => ['required', 'exists:menus,id'],
            'title' => ['required', 'max:255', 'string'],
            'ingredients' => ['nullable', 'max:255', 'string'],
            'price' => ['required', 'numeric'],
            'is_disponible' => ['required', 'boolean'],
            'is_vegetarian' => ['nullable', 'boolean'],
            'picture' => ['image', 'max:1024', 'nullable'],
        ];
    }
}

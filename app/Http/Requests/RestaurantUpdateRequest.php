<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantUpdateRequest extends FormRequest
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
            'title' => ['required', 'max:255', 'string'],
            'slug' => ['nullable', 'max:255', 'string'],
            'content' => ['nullable', 'max:255', 'string'],
            'excerpt' => ['nullable', 'max:255', 'string'],
            'is_published' => ['required', 'boolean'],
            'comment_status' => ['nullable', 'boolean'],
            'ping_status' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
            'thumbnail' => ['nullable', 'file'],
            'phone' => ['required', 'max:255', 'string'],
            'phone_2' => ['nullable', 'max:255', 'string'],
            'phone_3' => ['nullable', 'max:255', 'string'],
            'reservation_required' => ['nullable', 'boolean'],
            'website_url' => ['nullable', 'max:255', 'string'],
            'address' => ['nullable', 'max:255', 'string'],
            'city' => ['nullable', 'max:255', 'string'],
            'country' => ['nullable', 'max:255', 'string'],
        ];
    }
}

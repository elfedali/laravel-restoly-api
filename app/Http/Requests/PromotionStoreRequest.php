<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionStoreRequest extends FormRequest
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
            'price' => ['required', 'numeric'],
            'price_promo' => ['required', 'numeric'],
            'date_start' => ['nullable', 'date'],
            'date_end' => ['nullable', 'date'],
            'promotionable_id' => ['required', 'max:255'],
            'promotionable_type' => ['required', 'max:255', 'string'],
        ];
    }
}

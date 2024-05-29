<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PingStoreRequest extends FormRequest
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
            'pingable_id' => ['required', 'max:255'],
            'pingable_type' => ['required', 'max:255', 'string'],
            'date_start' => ['required', 'date'],
            'date_end' => ['nullable', 'date'],
            'note' => ['nullable', 'max:255', 'string'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}

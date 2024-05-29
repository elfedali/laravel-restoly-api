<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetaUpdateRequest extends FormRequest
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
            'metaable_id' => ['required', 'max:255'],
            'metaable_type' => ['required', 'max:255', 'string'],
            'meta_key' => ['required', 'max:255', 'string'],
        ];
    }
}

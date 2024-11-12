<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['nullable', 'exists:users'],
            'name' => ['required'],
            'is_default' => ['boolean'],
        ];
    }

    public function authorize(): true
    {
        return true;
    }
}

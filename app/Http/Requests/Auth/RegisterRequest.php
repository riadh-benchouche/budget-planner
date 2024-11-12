<?php

namespace App\Http\Requests\Auth;

use App\Enums\Roles;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'name' => 'required|string|min:3',
            'phone' => 'nullable|string|min:10',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email is required!',
            'email.email' => 'Email is not valid!',
            'email.unique' => 'Email is already taken!',
            'password.required' => 'Password is required!',
            'password.confirmed' => 'Password confirmation does not match!',
            'first_name.required' => 'First name is required!',
            'first_name.string' => 'First name must be string!',
            'first_name.min' => 'First name must be at least 3 characters!',
            'last_name.required' => 'Last name is required!',
            'last_name.string' => 'Last name must be string!',
            'last_name.min' => 'Last name must be at least 3 characters!',
            'role.required' => 'Role is required!',
            'role.enum' => 'Role is not valid!',
        ];
    }
}

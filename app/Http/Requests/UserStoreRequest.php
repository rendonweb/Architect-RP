<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|unique:users,email',
            'password'  => 'required|string|min:8',
            'role'      => ['required', Rule::in(['admin', 'user'])]
        ];
    }
}

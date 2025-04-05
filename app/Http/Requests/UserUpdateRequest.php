<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'      => 'sometimes|required|string|max:255',
            'email'     => ['sometimes', 'required', 'string', 'email', Rule::unique('users', 'email')->ignore($this->route('user')->id)],
            'password'  => 'sometimes|required|string|min:8',
            'role'      => ['sometimes', 'required', Rule::in(['admin', 'user'])]
        ];
    }
}

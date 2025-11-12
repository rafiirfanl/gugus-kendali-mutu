<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('user');

        return [
            'name' => 'required|max:100',
            'email' => [
                'required',
                'max:255',
                'email',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'password' => 'required|min:8',
            'role' => 'required',
            'email_verified' => 'required|in:0,1',
        ];
    }
}

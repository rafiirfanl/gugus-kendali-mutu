<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


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
            'nip' => [
                'required',
                'max:25',
            ],
            'password' => 'required|min:8',
            'role' => 'required',
            'prodi_id' => [
            'nullable',
            function ($attribute, $value, $fail) {
                if (Auth::user()->hasRole('gkmf')) {
                    if (in_array(request()->role, ['gkmp', 'kaprodi']) && !$value) {
                        $fail('Prodi wajib dipilih.');
                    }
                }
            }
            ],
            'email_verified' => 'required|in:0,1',
        ];
    }
}

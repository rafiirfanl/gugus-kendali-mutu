<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MatkulRequest extends FormRequest
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
        $id = $this->route('matkul');

        return [
            'nama_matkul' => 'required|max:100',
            'kode_matkul' => [
                'required',
                'max:255',
                Rule::unique('matkuls', 'kode_matkul')->ignore($id),
            ],
            'bobot_sks' => 'required|numeric',
            'praktikum' => 'required|boolean',
            'prodi_id' => 'required',
        ];
    }
}

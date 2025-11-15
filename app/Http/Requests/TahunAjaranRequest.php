<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TahunAjaranRequest extends FormRequest
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
        return [
            'tahun1' => 'required|digits:4|integer|min:2000|max:3000',
            'tahun2' => 'required|digits:4|integer|min:2000|max:3000',
            'jenis' => 'required|in:Ganjil,Genap,Pendek',
            'tanggal_mulai_kuliah' => 'required|date',
        ];
    }
}

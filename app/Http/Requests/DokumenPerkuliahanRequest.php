<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DokumenPerkuliahanRequest extends FormRequest
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
            'nama_dokumen' => 'required|max:100',
            'sesi'=>'required',
            'tenggat_waktu_default'  => 'required|integer|max:3000',
            'template' => 'required|file|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx|max:2048',
        ];
    }
}

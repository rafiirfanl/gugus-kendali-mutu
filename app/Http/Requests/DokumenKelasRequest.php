<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DokumenKelasRequest extends FormRequest
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
            'kelas_id' => 'required|exists:kelas,id',
            'dokumen_perkuliahan_id' => 'required|exists:dokumen_perkuliahans,id',
            'file_dokumen' => 'required|file|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx|max:2048',
            'waktu_pengumpulan' => 'required|date',
            'status' => 'required|in:dikumpulkan,ditolak',
            'catatan' => 'nullable|string|max:500',
        ];
    }
}

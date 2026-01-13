<?php

namespace App\Http\Controllers\Admin\DataTemuan;

use App\Http\Controllers\Controller;
use App\Models\HasilTemuan;
use App\Models\TindakLanjut;
use Illuminate\Http\Request;

class TindakLanjutController extends Controller
{
    public function index()
    {
        $hasil_temuans = HasilTemuan::all();
        return view('admin.data-temuan.tindak-lanjut.index', compact('hasil_temuans'));
    }

    public function store(Request $request, $hasil_temuan_id)
    {
        $request->validate([
            'hasil_temuan_id' => 'required|exists:hasil_temuans,id',
            'prodi_id' => 'required|exists:prodis,id',
            'tindak_lanjut' => 'nullable|string|max:500',
            'masukan' => 'nullable|string|max:500',
            'kendala' => 'nullable|string|max:500',
        ]);

        TindakLanjut::create([
            'hasil_temuan_id' => $hasil_temuan_id,
            'prodi_id' => $request->prodi_id,
            'tindak_lanjut' => $request->tindak_lanjut,
            'kendala' => $request->kendala,
            'masukan' => $request->masukan,
        ]);

        return back()->with('success', 'Tindak Lanjut berhasil ditugaskan');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\TahunAjaran;
use App\Http\Requests\TahunAjaranRequest;

class AdminTahunAjaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view:tahun-ajaran')->only(['index']);
        $this->middleware('permission:create:tahun-ajaran')->only(['store']);
        $this->middleware('permission:edit:tahun-ajaran')->only(['update']);
        $this->middleware('permission:delete:tahun-ajaran')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahunAjarans = TahunAjaran::all();
        return view('admin.tahun-ajaran.index', compact('tahunAjarans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TahunAjaranRequest $request)
    {
        // Gabungkan tahun1/tahun2 menjadi format 2025/2026
        $tahun_ajaran = $request->tahun1 . '/' . $request->tahun2;

        // Semua data lama dibuat tidak aktif
        TahunAjaran::where('is_aktif', true)->update(['is_aktif' => false]);

        // Simpan TA baru sebagai aktif
        TahunAjaran::create([
            'tahun_ajaran'          => $tahun_ajaran,
            'jenis'                 => $request->jenis,
            'tanggal_mulai_kuliah'  => $request->tanggal_mulai_kuliah,
            'is_aktif'              => 1, // otomatis aktif
        ]);

        return back()->with('success', 'Tahun Ajaran Baru Berhasil Ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TahunAjaranRequest $request, TahunAjaran $tahunAjaran)
    {
        $data = $request->validated();
        $tahunAjaran->update($data);
        return back()->with('success', 'Successfully Update Tahun Ajaran!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $tahunAjaran)
    {
        TahunAjaran::findOrFail($tahunAjaran)->forceDelete();
        return back()->with('success', 'Successfully Delete Tahun Ajaran!');
    }
}

<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\TahunAjaran;
use App\Models\Matkul;
use App\Models\Kelas;
use App\Http\Requests\KelasRequest;

class AdminKelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view:kelas')->only(['index']);
        $this->middleware('permission:create:kelas')->only(['store']);
        $this->middleware('permission:edit:kelas')->only(['update']);
        $this->middleware('permission:delete:kelas')->only(['destroy']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahunAjarans = TahunAjaran::all();
        $matkuls = Matkul::all();
        $kelases = Kelas::all();
        return view('admin.kelas.index', compact('kelases', 'matkuls', 'tahunAjarans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KelasRequest $request)
    {
        $data = $request->validated();
        Kelas::create($data);
        return back()->with('success', 'Successfully Add New Kelas!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KelasRequest $request, Kelas $kelas)
    {
        $data = $request->validated();
        $kelas->update($data);
        return back()->with('success', 'Successfully Update Kelas!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kelas)
    {
        Kelas::findOrFail($kelas)->forceDelete();
        return back()->with('success', 'Successfully Delete Kelas!');
    }
}

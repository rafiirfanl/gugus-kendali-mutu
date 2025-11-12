<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\TahunAjaran;
use App\Http\Requests\TahunAjaranRequest;

class AdminTahunAjaranController extends Controller
{
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TahunAjaranRequest $request, TahunAjaran $tahunAjaran)
    {
        //
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

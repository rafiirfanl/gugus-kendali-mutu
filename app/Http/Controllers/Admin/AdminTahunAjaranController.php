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
        $data = $request->validated();
        TahunAjaran::create($data);
        return back()->with('success', 'Successfully Add New Tahun Ajaran!');
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

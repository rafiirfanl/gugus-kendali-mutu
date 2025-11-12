<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Matkul;
use App\Models\Prodi;
use App\Http\Requests\MatkulRequest;

class AdminMatkulController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view:matkul')->only(['index']);
        $this->middleware('permission:create:matkul')->only(['store']);
        $this->middleware('permission:edit:matkul')->only(['update']);
        $this->middleware('permission:delete:matkul')->only(['destroy']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodis = Prodi::all();
        $matkuls = Matkul::all();
        return view('admin.matkul.index', compact('matkuls', 'prodis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MatkulRequest $request)
    {
        $data = $request->validated();
        Matkul::create($data);
        return back()->with('success', 'Successfully Add New Matkul!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MatkulRequest $request, Matkul $matkul)
    {
        $data = $request->validated();
        $matkul->update($data);
        return back()->with('success', 'Successfully Update Matkul!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $matkul)
    {
        Matkul::findOrFail($matkul)->forceDelete();
        return back()->with('success', 'Successfully Delete Matkul!');
    }
}

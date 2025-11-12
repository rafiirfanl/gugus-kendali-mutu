<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Prodi;
use App\Http\Requests\ProdiRequest;


class AdminProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodis = Prodi::all();
        return view('admin.prodi.index', compact('prodis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdiRequest $request)
    {
        $data = $request->validated();
        Prodi::create($data);
        return back()->with('success', 'Successfully Add New Prodi!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdiRequest $request, Prodi $prodi)
    {
        $data = $request->validated();
        $prodi->update($data);
        return back()->with('success', 'Successfully Update Prodi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $prodi)
    {
        Prodi::findOrFail($prodi)->forceDelete();
        return back()->with('success', 'Successfully Delete Prodi!');
    }
}

<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Matkul;
use App\Http\Requests\MatkulRequest;

class AdminMatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matkuls = Matkul::all();
        return view('admin.matkul.index', compact('matkuls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MatkulRequest $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MatkulRequest $request, Matkul $matkul)
    {
        //
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

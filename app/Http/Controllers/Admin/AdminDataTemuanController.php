<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\DataTemuan;
use App\Http\Requests\DataTemuanRequest;

class AdminDataTemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataTemuans = DataTemuan::all();
        return view('admin.data-temuan.index', compact('dataTemuans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataTemuanRequest $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DataTemuanRequest $request, DataTemuan $dataTemuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $dataTemuan)
    {
        DataTemuan::findOrFail($dataTemuan)->forceDelete();
        return back()->with('success', 'Successfully Delete Data Temuan!');
    }
}

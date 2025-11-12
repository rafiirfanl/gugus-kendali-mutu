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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataTemuanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DataTemuan $dataTemuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataTemuan $dataTemuan)
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
    public function destroy(DataTemuan $dataTemuan)
    {
        //
    }
}

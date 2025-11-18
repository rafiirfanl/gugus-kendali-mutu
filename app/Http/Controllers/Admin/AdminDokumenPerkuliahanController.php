<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenPerkuliahan;
use App\Http\Requests\DokumenPerkuliahanRequest;
use Illuminate\Support\Facades\Storage;

class AdminDokumenPerkuliahanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view:dokumen-perkuliahan')->only(['index']);
        $this->middleware('permission:create:dokumen-perkuliahan')->only(['store']);
        $this->middleware('permission:edit:dokumen-perkuliahan')->only(['update']);
        $this->middleware('permission:delete:dokumen-perkuliahan')->only(['destroy']);
    }


    public function index()
    {
        $dokumenPerkuliahans = DokumenPerkuliahan::all();
        return view('admin.dokumen-perkuliahan.index', compact('dokumenPerkuliahans'));
    }
    public function store(DokumenPerkuliahanRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('template')) {
            $filePath = $request->file('template')->store('dokumen_perkuliahan', 'public');
            $data['template'] = $filePath;
        }
        DokumenPerkuliahan::create($data);
        return back()->with('success', 'Successfully Add New Dokumen Perkuliahan!');
    }
    public function update(DokumenPerkuliahanRequest $request, DokumenPerkuliahan $dokumenPerkuliahan)
    {
        $data = $request->validated();
        if ($request->hasFile('template')) {
            $filePath = $request->file('template')->store('dokumen_perkuliahan', 'public');
            if ($dokumenPerkuliahan->template && Storage::disk('public')->exists($dokumenPerkuliahan->template)) {
                Storage::disk('public')->delete($dokumenPerkuliahan->template);
            }
            $data['template'] = $filePath;
        }
        $dokumenPerkuliahan->update($data);
        return back()->with('success', 'Successfully Update DokumenPerkuliahan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $dokumenPerkuliahan)
    {
        $dokumen = DokumenPerkuliahan::findOrFail($dokumenPerkuliahan);

        $filePath = $dokumen->template;

        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        $dokumen->forceDelete();

        return back()->with('success', 'Successfully Delete Dokumen Perkuliahan and associated file!');
    }
}

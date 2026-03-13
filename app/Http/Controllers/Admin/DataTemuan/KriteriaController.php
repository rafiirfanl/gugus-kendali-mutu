<?php

namespace App\Http\Controllers\Admin\DataTemuan;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::with('subkriterias')->get();
        return view('admin.data-temuan.kriteria.index', compact('kriteria'));
    }

    public function create()
    {
        return view('admin.data-temuan.kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:kriterias,nama',
        ]);

        Kriteria::create($request->all());

        return redirect()->route('admin.temuan.index')
            ->with('success', 'Kriteria berhasil ditambahkan');
    }


    public function show($id)
    {
        $kriteria = Kriteria::with('subkriterias')->findOrFail($id);
        return view('admin.data-temuan.kriteria.show', compact('kriteria'));
    }

    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('admin.data-temuan.kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|unique:kriterias,nama,' . $id,
        ]);

        $kriteria = Kriteria::findOrFail($id);
        $kriteria->update($request->all());

        return redirect()->route('admin.temuan.index')
            ->with('success', 'Kriteria diperbarui');
    }


    public function destroy($id)
    {
        Kriteria::findOrFail($id)->delete();
        return redirect()->route('admin.temuan.index')->with('success', 'Kriteria dihapus');
    }
}

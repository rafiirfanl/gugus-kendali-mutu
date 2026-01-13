<?php

namespace App\Http\Controllers\Admin\DataTemuan;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Http\Requests\StoreSubKriteriaRequest;
use App\Http\Requests\UpdateSubKriteriaRequest;

class SubkriteriaController extends Controller
{
    public function create($kriteria_id)
    {
        $kriteria = Kriteria::findOrFail($kriteria_id);
        return view('admin.data-temuan.subkriteria.create', compact('kriteria'));
    }

    public function store(StoreSubKriteriaRequest $request, $kriteria_id)
    {
        $data = $request->validated();
        $data['kriteria_id'] = $kriteria_id;

        $sub = Subkriteria::create($data);

        foreach ($request->hasil_temuan as $hasil) {
            $sub->hasilTemuans()->create([
                'hasil_temuan' => $hasil
            ]);
        }

        return redirect()
            ->route('admin.temuan.show', $kriteria_id)
            ->with('success', 'Subkriteria & hasil temuan berhasil ditambahkan');
    }

    public function edit($kriteria_id, $id)
    {
        $kriteria = Kriteria::findOrFail($kriteria_id);

        $sub = Subkriteria::with('hasilTemuan')->findOrFail($id);

        return view('admin.data-temuan.subkriteria.edit', compact('kriteria', 'sub'));
    }


    public function update(UpdateSubKriteriaRequest $request, $kriteria_id, $sub_id)
    {
        $sub = Subkriteria::findOrFail($sub_id);
        $data = $request->validated();
        $sub->update($data);

        $ids = json_decode($request->ids, true);
        $values = json_decode($request->values, true);

        foreach ($ids as $index => $id) {

            if ($id === "new") {
                $sub->hasilTemuans()->create([
                    'hasil_temuan' => $values[$index]
                ]);
            } else {
                $hasil = $sub->hasilTemuans()->find($id);
                if ($hasil) {
                    $hasil->update([
                        'hasil_temuan' => $values[$index]
                    ]);
                }
            }
        }

        if ($request->deleted_ids) {
            $deletedIds = json_decode($request->deleted_ids, true);

            if (!empty($deletedIds)) {
                $sub->hasilTemuans()->whereIn('id', $deletedIds)->delete();
            }
        }

        return redirect()
            ->route('admin.temuan.show', $kriteria_id)
            ->with('success', 'Subkriteria berhasil diperbarui');
    }


    public function destroy(string $id)
    {
        Subkriteria::findOrFail($id)->delete();
        return back()->with('success', 'Subkriteria dihapus');
    }
}

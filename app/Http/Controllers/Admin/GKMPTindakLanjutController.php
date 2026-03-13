<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TindakLanjut;
use Illuminate\Http\Request;

class GKMPTindakLanjutController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:progres:tindak-lanjut')->only(['index']);
        $this->middleware('permission:update:tindak-lanjut')->only(['update']);
    }

    public function index()
    {
        $prodi_id = auth()->user()->prodi_id;

        $tindakLanjuts = TindakLanjut::with([
            'hasilTemuan.subkriteria.kriteria'
        ])
            ->where('prodi_id', $prodi_id)
            ->get();

        // ===============================
        // TOTAL PROGRES PRODI
        // ===============================
        $total = $tindakLanjuts->count();

        $selesai = $tindakLanjuts->filter(function ($item) {
            return !empty($item->masukan)
                && !empty($item->tindak_lanjut)
                && !empty($item->kendala);
        })->count();

        $persenProdi = $total > 0
            ? round(($selesai / $total) * 100, 2)
            : 0;

        // ===============================
        // GROUP PER KRITERIA & SUBKRITERIA
        // ===============================
        $tindak_lanjuts = $tindakLanjuts
            ->groupBy(function ($item) {
                return $item->hasilTemuan->subkriteria->kriteria->nama ?? 'Tanpa Kriteria';
            })
            ->map(function ($groupKriteria) {

                $totalKriteria = $groupKriteria->count();

                $selesaiKriteria = $groupKriteria->filter(function ($item) {
                    return !empty($item->masukan)
                        && !empty($item->tindak_lanjut)
                        && !empty($item->kendala);
                })->count();

                $persenKriteria = $totalKriteria > 0
                    ? round(($selesaiKriteria / $totalKriteria) * 100, 2)
                    : 0;

                $subkriteria = $groupKriteria->groupBy(function ($item) {
                    return $item->hasilTemuan->subkriteria->kode ?? 'Tanpa Subkriteria';
                })->map(function ($groupSub) {

                    $totalSub = $groupSub->count();

                    $selesaiSub = $groupSub->filter(function ($item) {
                        return !empty($item->masukan)
                            && !empty($item->tindak_lanjut)
                            && !empty($item->kendala);
                    })->count();

                    $persenSub = $totalSub > 0
                        ? round(($selesaiSub / $totalSub) * 100, 2)
                        : 0;

                    return [
                        'items' => $groupSub,
                        'persen' => $persenSub,
                    ];
                });

                return [
                    'subkriteria' => $subkriteria,
                    'persen' => $persenKriteria,
                ];
            });

        return view(
            'gkmp.progres-tindak-lanjut.index',
            compact('tindak_lanjuts', 'persenProdi', 'total', 'selesai')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'masukan' => 'required|string',
            'tindak_lanjut' => 'required|string',
            'kendala' => 'required|string',
        ]);

        $tindakLanjut = TindakLanjut::findOrFail($id);

        $prodi_id = auth()->user()->prodi_id;

        $tindakLanjut->update([
            'prodi_id' => $prodi_id,
            'masukan' => $request->masukan,
            'tindak_lanjut' => $request->tindak_lanjut,
            'kendala' => $request->kendala,
        ]);

        return back()->with('success', 'Tindak lanjut berhasil disimpan');
    }
}

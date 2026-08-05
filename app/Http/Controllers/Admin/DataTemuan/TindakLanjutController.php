<?php

namespace App\Http\Controllers\Admin\DataTemuan;

use App\Http\Controllers\Controller;
use App\Models\HasilTemuan;
use App\Models\TindakLanjut;
use App\Models\Prodi;

class TindakLanjutController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:generate:tindak-lanjut')->only(['index', 'generate']);
    }

    public function index()
    {
        // Ambil SEMUA tindak lanjut yang sudah digenerate
        $tindakLanjuts = TindakLanjut::with([
            'prodi',
            'hasilTemuan.subkriteria.kriteria'
        ])->get();

        // Kalau BELUM PERNAH generate
        if ($tindakLanjuts->isEmpty()) {
            return view('admin.data-temuan.tindak-lanjut.index', [
                'data' => collect(),
                'belumGenerate' => true
            ]);
        }

        $data = $tindakLanjuts
            ->groupBy(fn($tl) => $tl->prodi->id)
            ->map(function ($group) {

                $prodi = $group->first()->prodi;

                $total = $group->count();

                $selesai = $group->filter(function ($tl) {
                    return !empty($tl->masukan)
                        && !empty($tl->tindak_lanjut)
                        && !empty($tl->kendala);
                })->count();

                $persen = $total > 0
                    ? round(($selesai / $total) * 100, 2)
                    : 0;

                return [
                    'prodi' => $prodi,
                    'total' => $total,
                    'selesai' => $selesai,
                    'persen' => $persen,
                ];
            })
            ->values();

        return view('admin.data-temuan.tindak-lanjut.index', [
            'data' => $data,
            'belumGenerate' => false
        ]);
    }

    public function show(Prodi $tindak_lanjut)
    {
        $prodi = $tindak_lanjut;

        $tindakLanjuts = TindakLanjut::with([
            'hasilTemuan.subkriteria.kriteria',
        ])
            ->where('prodi_id', $prodi->id)
            ->get();

        $total = $tindakLanjuts->count();
        $selesai = $tindakLanjuts->filter(function ($tl) {
            return !empty($tl->masukan)
                && !empty($tl->tindak_lanjut)
                && !empty($tl->kendala);
        })->count();
        $persen = $total > 0 ? round(($selesai / $total) * 100, 1) : 0;

        $grouped = $tindakLanjuts
            ->groupBy(fn($tl) => $tl->hasilTemuan->subkriteria->kriteria->nama_kriteria)
            ->map(function ($kriteriaGroup) {
                $kriteriaPersen = $kriteriaGroup->filter(function ($tl) {
                    return !empty($tl->masukan)
                        && !empty($tl->tindak_lanjut)
                        && !empty($tl->kendala);
                })->count();
                $kriteriaTotal = $kriteriaGroup->count();

                return [
                    'persen' => $kriteriaTotal > 0 ? round(($kriteriaPersen / $kriteriaTotal) * 100, 1) : 0,
                    'subkriteria' => $kriteriaGroup
                        ->groupBy(fn($tl) => $tl->hasilTemuan->subkriteria->nama_subkriteria)
                        ->map(function ($subGroup) {
                            $subPersen = $subGroup->filter(function ($tl) {
                                return !empty($tl->masukan)
                                    && !empty($tl->tindak_lanjut)
                                    && !empty($tl->kendala);
                            })->count();
                            $subTotal = $subGroup->count();

                            return [
                                'persen' => $subTotal > 0 ? round(($subPersen / $subTotal) * 100, 1) : 0,
                                'items' => $subGroup,
                            ];
                        }),
                ];
            });

        return view('admin.data-temuan.tindak-lanjut.show', compact('prodi', 'total', 'selesai', 'persen', 'grouped'));
    }

    public function generate()
    {
        $hasilTemuans = HasilTemuan::all();
        $prodis = Prodi::all();

        foreach ($hasilTemuans as $hasilTemuan) {
            foreach ($prodis as $prodi) {

                $exists = TindakLanjut::where('hasil_temuan_id', $hasilTemuan->id)
                    ->where('prodi_id', $prodi->id)
                    ->exists();

                if (!$exists) {
                    TindakLanjut::create([
                        'hasil_temuan_id' => $hasilTemuan->id,
                        'prodi_id' => $prodi->id,
                        'tindak_lanjut' => null,
                        'kendala' => null,
                        'masukan' => null,
                    ]);
                }
            }
        }

        return back()->with('success', 'Tindak Lanjut berhasil digenerate untuk seluruh Prodi');
    }
}

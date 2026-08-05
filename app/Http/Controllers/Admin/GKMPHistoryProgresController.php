<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\DokumenKelas;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;

class GKMPHistoryProgresController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view:history-progres')->only(['index']);
    }

    public function index()
    {
        $userProdi = Auth::user()->prodi_id;

        $tahunAjarans = TahunAjaran::orderBy('tahun_ajaran', 'desc')
            ->orderByRaw("CASE jenis WHEN 'Ganjil' THEN 1 WHEN 'Genap' THEN 2 WHEN 'Pendek' THEN 3 END")
            ->get();

        $history = $tahunAjarans->map(function ($ta) use ($userProdi) {
            $kelasIds = Kelas::where('tahun_ajaran_id', $ta->id)
                ->whereHas('matkulDibuka.matkul', function ($q) use ($userProdi) {
                    $q->where('prodi_id', $userProdi);
                })
                ->pluck('id');

            $totalKelas = $kelasIds->count();

            $totalDitugaskan = DokumenKelas::whereIn('kelas_id', $kelasIds)
                ->whereNull('status')
                ->count();

            $totalTerkumpul = DokumenKelas::whereIn('kelas_id', $kelasIds)
                ->where('status', 'dikumpulkan')
                ->count();

            $totalDitolak = DokumenKelas::whereIn('kelas_id', $kelasIds)
                ->where('status', 'ditolak')
                ->count();

            $totalSemua = $totalDitugaskan + $totalTerkumpul + $totalDitolak;
            $persentase = $totalSemua > 0 ? round(($totalTerkumpul / $totalSemua) * 100, 1) : 0;

            return [
                'id' => $ta->id,
                'tahun_ajaran' => $ta->tahun_ajaran,
                'jenis' => $ta->jenis,
                'is_aktif' => $ta->is_aktif,
                'total_kelas' => $totalKelas,
                'total_ditugaskan' => $totalDitugaskan,
                'total_terkumpul' => $totalTerkumpul,
                'total_ditolak' => $totalDitolak,
                'total_semua' => $totalSemua,
                'persentase' => $persentase,
            ];
        });

        return view('gkmp.history-progres.index', compact('history'));
    }
}

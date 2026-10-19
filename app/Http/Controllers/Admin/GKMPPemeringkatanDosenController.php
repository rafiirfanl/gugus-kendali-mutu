<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use App\Services\PemeringkatanDosenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GKMPPemeringkatanDosenController extends Controller
{
    public function __construct(private PemeringkatanDosenService $pemeringkatan)
    {
        $this->middleware('permission:view:pemeringkatan-dosen')->only(['index']);
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $tahunAjaranList = TahunAjaran::orderBy('tahun_ajaran', 'desc')
            ->orderByRaw("CASE jenis WHEN 'Ganjil' THEN 1 WHEN 'Genap' THEN 2 WHEN 'Pendek' THEN 3 END")
            ->get();

        $tahunAjaran = $request->filled('tahun_ajaran')
            ? $tahunAjaranList->firstWhere('id', $request->tahun_ajaran)
            : null;

        $tahunAjaran = $tahunAjaran
            ?? $tahunAjaranList->firstWhere('is_aktif', true)
            ?? $tahunAjaranList->first();

        // GKMF: melihat seluruh prodi (bisa difilter). GKMP/Kaprodi: prodi tanggung jawabnya.
        $prodiList = collect();
        $prodiId = null;

        if ($user->hasRole('gkmf')) {
            $prodiList = Prodi::orderBy('nama_prodi')->get();

            if ($request->filled('prodi')) {
                $prodiId = (int) $request->prodi;
            }
        } else {
            // GKMP/Kaprodi terkunci pada prodi tanggung jawabnya
            // (0 = prodi tidak ada, maka tidak ada baris yang cocok)
            $prodiId = (int) $user->prodi_id;
        }

        $leaderboard = collect();

        if ($tahunAjaran) {
            $kelasList = Kelas::with(['dosen.prodi', 'matkulDibuka.matkul.prodi', 'dokumenKelas.dokumenPerkuliahan'])
                ->where('tahun_ajaran_id', $tahunAjaran->id)
                ->get();

            $leaderboard = collect($this->pemeringkatan->hitung($kelasList, $tahunAjaran, $prodiId));
        }

        return view('gkmp.pemeringkatan-dosen.index', compact(
            'leaderboard',
            'tahunAjaranList',
            'tahunAjaran',
            'prodiList',
            'prodiId'
        ));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\DokumenKelas;
use Illuminate\Http\Request;

class GKMPProgresKelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view:progres-kelas')->only(['index']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelasList = Kelas::withCount([])->get();

        $progres = DokumenKelas::selectRaw("
            kelas_id,

            -- TERKUMPUL = dikumpulkan
            SUM(CASE WHEN status IN ('dikumpulkan') THEN 1 ELSE 0 END) AS terkumpul,

            -- DITUGASKAN = status NULL + ditolak
            SUM(CASE WHEN status IS NULL OR status = 'ditolak' THEN 1 ELSE 0 END) AS ditugaskan

        ")
            ->groupBy('kelas_id')
            ->get()
            ->keyBy('kelas_id');

        return view('gkmp.progres-kelas.index', compact('kelasList', 'progres'));
    }

    public function detailKelas(string $kelasId)
    {
        $dokumenKelas = DokumenKelas::where('kelas_id', $kelasId)->get();

        return view('gkmp.progres-kelas.detail-kelas', compact('kelasId', 'dokumenKelas'));
    }

    public function tolak(Request $request)
    {
        $request->validate([
            'dokumen_kelas_id' => 'required|exists:dokumen_kelas,id',
            'catatan' => 'required|string|min:3'
        ]);

        $dokumen = DokumenKelas::findOrFail($request->dokumen_kelas_id);

        $dokumen->update([
            'status' => 'ditolak',
            'catatan' => $request->catatan,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Dokumen berhasil ditolak dengan catatan.');
    }
}

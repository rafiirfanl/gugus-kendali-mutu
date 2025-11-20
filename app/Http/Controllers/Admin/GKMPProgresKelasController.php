<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\User;
use App\Models\DokumenKelas;
use App\Models\DokumenPerkuliahan;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

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
        $tahunAjaran = TahunAjaran::where('is_aktif', true)->first();
        $userProdi = Auth::user()->prodi_id;
        $kelasList = Kelas::where('tahun_ajaran_id', $tahunAjaran->id)
            ->whereHas('matkulDibuka.matkul', function ($q) use ($userProdi) {
                $q->where('prodi_id', $userProdi);
            })
            ->get();

        $sesiList = DokumenPerkuliahan::select('sesi')->distinct()->orderBy('sesi')->get();
        $now = now();

        $progres = DokumenKelas::selectRaw("
        dokumen_kelas.kelas_id,

        -- TERKUMPUL
        SUM(CASE WHEN dokumen_kelas.status = 'dikumpulkan' THEN 1 ELSE 0 END) AS terkumpul,

        -- DITUGASKAN
        SUM(CASE WHEN dokumen_kelas.status IS NULL OR dokumen_kelas.status = 'ditolak' THEN 1 ELSE 0 END) AS ditugaskan,

        -- TERLEWAT
        SUM(
            CASE
                WHEN dp.tenggat_waktu_default < ?
                AND (dokumen_kelas.status IS NULL OR dokumen_kelas.status = 'ditolak')
                THEN 1 ELSE 0
            END
        ) AS terlewat
    ", [$now])
            ->leftJoin('dokumen_perkuliahans as dp', 'dp.id', 'dokumen_kelas.dokumen_perkuliahan_id')
            ->groupBy('dokumen_kelas.kelas_id')
            ->get()
            ->keyBy('kelas_id');

        return view('gkmp.progres-kelas.index', compact('kelasList', 'progres', 'sesiList'));
    }

    public function previewSesiPDF($sesi)
    {
        $now = now();
        $tahunAjaran = TahunAjaran::where('is_aktif', true)->first();
        $userProdi = Auth::user()->prodi_id;
        $kelasList = Kelas::where('tahun_ajaran_id', $tahunAjaran->id)
            ->whereHas('matkulDibuka.matkul', function ($q) use ($userProdi) {
                $q->where('prodi_id', $userProdi);
            })
            ->get();

        $progres = DokumenKelas::selectRaw("
        dokumen_kelas.kelas_id,
        SUM(CASE WHEN dokumen_kelas.status = 'dikumpulkan' THEN 1 ELSE 0 END) AS terkumpul,
        SUM(CASE WHEN dokumen_kelas.status IS NULL OR dokumen_kelas.status = 'ditolak' THEN 1 ELSE 0 END) AS ditugaskan,
        SUM(
            CASE
                WHEN dp.tenggat_waktu_default < ?
                AND (dokumen_kelas.status IS NULL OR dokumen_kelas.status = 'ditolak')
            THEN 1 ELSE 0
            END
        ) AS terlewat
    ", [$now])
            ->leftJoin('dokumen_perkuliahans as dp', 'dp.id', 'dokumen_kelas.dokumen_perkuliahan_id')
            ->whereHas('dokumenPerkuliahan', function ($q) use ($sesi) {
                $q->where('sesi', $sesi);
            })
            ->groupBy('dokumen_kelas.kelas_id')
            ->get()
            ->keyBy('kelas_id');

        $namaDokumenList = DokumenPerkuliahan::where('sesi', $sesi)
            ->pluck('nama_dokumen')
            ->toArray();

        $groupedProgres = [];

        foreach ($kelasList as $kelas) {
            $dokumens = [];

            foreach ($namaDokumenList as $dokumenName) {

                $dokumenPerkuliahan = DokumenPerkuliahan::where('sesi', $sesi)
                    ->where('nama_dokumen', $dokumenName)
                    ->first();

                if (!$dokumenPerkuliahan) {
                    $dokumens[$dokumenName] = false;
                    continue;
                }

                $dokumenKelas = DokumenKelas::where('kelas_id', $kelas->id)
                    ->where('dokumen_perkuliahan_id', $dokumenPerkuliahan->id)
                    ->first();

                $dokumens[$dokumenName] = $dokumenKelas && $dokumenKelas->status === 'dikumpulkan';
            }

            $groupedProgres[] = [
                'matkul' => $kelas->matkul->nama_matkul ?? '-',
                'dosen'  => $kelas->dosen->name ?? '-',
                'dokumens' => $dokumens,
            ];
        }

        $kelas = $kelasList->first();

        $prodi_id    = $kelas?->matkulDibuka?->matkul?->prodi_id;
        $nama_prodi  = $kelas?->matkulDibuka?->matkul?->prodi?->nama_prodi ?? '-';
        $ruang_prodi = $kelas?->matkulDibuka?->matkul?->prodi?->ruang_prodi ?? '-';

        $kaprodiUser = User::role('kaprodi')
            ->where('prodi_id', $prodi_id)
            ->first();

        $kaprodi     = $kaprodiUser->name ?? '-';
        $nip_kaprodi = $kaprodiUser->nip  ?? '-';

        $gkmpUser = User::role('gkmp')
            ->where('prodi_id', $prodi_id)
            ->first();

        $gkmp     = $gkmpUser->name ?? '-';
        $nip_gkmp = $gkmpUser->nip  ?? '-';


        // LOAD VIEW PDF
        $pdf = Pdf::loadView('gkmp.progres-kelas.sesi', [
            'kelasList' => $kelasList,
            'progres'   => $progres,
            'sesi'      => $sesi,
            'namaDokumenList' => $namaDokumenList,
            'groupedProgres' => $groupedProgres,
            'dokumenSesi'    => $namaDokumenList,
            'nama_prodi' => $nama_prodi,
            'ruang_prodi' => $ruang_prodi,
            'kaprodi' => $kaprodi,
            'nip_kaprodi' => $nip_kaprodi,
            'gkmp' => $gkmp,
            'nip_gkmp' => $nip_gkmp,
        ]);

        return $pdf->stream('Progres Sesi ' . $sesi . '.pdf');
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

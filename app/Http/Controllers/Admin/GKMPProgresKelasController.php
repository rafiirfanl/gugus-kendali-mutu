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

        $tahunAjaran = TahunAjaran::where('is_aktif', true)->first();
        $dokumenPerkuliahan = DokumenPerkuliahan::all();
        $tanggalMulaiKuliah = $tahunAjaran ? $tahunAjaran->tanggal_mulai_kuliah : null;

        // isi dari dokumen perkuliahan
        $sesiList = DokumenPerkuliahan::select('sesi')->distinct()->orderBy('sesi')->get();
        $now = now(); // Carbon instance

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

        // dd($sesiList);


        return view('gkmp.progres-kelas.index', compact('kelasList', 'progres', 'sesiList'));
    }

    public function previewSesiPDF($sesi)
    {
        $now = now();

        // Ambil semua kelas yang memiliki dokumen dengan sesi tertentu
        $kelasList = Kelas::whereHas('dokumenKelas.dokumenPerkuliahan', function ($q) use ($sesi) {
            $q->where('sesi', $sesi);
        })->get();

        // Hitung progres
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

        $tempat = "Ruang D215, Prodi Teknik Informatika";

        $groupedProgres = [];

        foreach ($kelasList as $kelas) {
            $dokumens = [];

            foreach ($namaDokumenList as $dokumenName) {

                // Cari dokumen perkuliahan berdasarkan nama + sesi
                $dokumenPerkuliahan = DokumenPerkuliahan::where('sesi', $sesi)
                    ->where('nama_dokumen', $dokumenName)
                    ->first();

                if (!$dokumenPerkuliahan) {
                    $dokumens[$dokumenName] = false;
                    continue;
                }

                // Cari apakah kelas ini punya dokumen tersebut
                $dokumenKelas = DokumenKelas::where('kelas_id', $kelas->id)
                    ->where('dokumen_perkuliahan_id', $dokumenPerkuliahan->id)
                    ->first();

                // Status: dikumpulkan = Ada, lainnya = Tidak Ada
                $dokumens[$dokumenName] = $dokumenKelas && $dokumenKelas->status === 'dikumpulkan';
            }

            $groupedProgres[] = [
                'matkul' => $kelas->matkul->nama_matkul ?? '-',
                'dosen'  => $kelas->dosen->name ?? '-',
                'dokumens' => $dokumens,
            ];
        }

        $prodi = optional(optional($kelasList->first())->matkul)->prodi->nama_prodi ?? '-';
        $kaprodiUser = User::role('kaprodi')
            ->where('prodi_id', optional(optional($kelasList->first())->matkul)->prodi_id)
            ->first();
        $kaprodi = $kaprodiUser->name ?? '-';
        $nip_kaprodi = $kaprodiUser->nip ?? '-';
        $gkmpUser = User::role('gkmp')
            ->where('prodi_id', optional(optional($kelasList->first())->matkul)->prodi_id)
            ->first();
        $gkmp = $gkmpUser->name ?? '-';
        $nip_gkmp = $gkmpUser->nip ?? '-';


        // LOAD VIEW PDF
        $pdf = Pdf::loadView('gkmp.progres-kelas.sesi', [
            'kelasList' => $kelasList,
            'progres'   => $progres,
            'sesi'      => $sesi,
            'namaDokumenList' => $namaDokumenList,
            'tempat' => $tempat,
            'groupedProgres' => $groupedProgres,
            'dokumenSesi'    => $namaDokumenList,
            'prodi' => $prodi,
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

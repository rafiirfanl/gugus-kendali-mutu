<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\DokumenKelas;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DosenKelasDiampuController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tahunAktif = TahunAjaran::where('is_aktif', 1)->first();

        if (!$tahunAktif) {
            return view('dosen.kelas-diampu.index', [
                'kelas' => [],
                'tahunAktif' => null,
                'message' => 'Belum ada Tahun Ajaran aktif.'
            ]);
        }

        $kelas = Kelas::with(['matkulDibuka.matkul'])
            ->where('dosen_id', $user->id)
            ->where('tahun_ajaran_id', $tahunAktif->id)
            ->get();

        return view('dosen.kelas-diampu.index', compact('kelas', 'tahunAktif'));
    }

    public function show($kelasID)
    {
        $dosenId = Auth::id();

        $kelasList = Kelas::with(['matkulDibuka.matkul', 'dokumenKelas.dokumenPerkuliahan'])
            ->where('dosen_id', $dosenId)
            ->where('id', $kelasID)
            ->get();

        $dokumenKelas = DokumenKelas::whereIn('kelas_id', $kelasList->pluck('id'))->get();

        return view('dosen.kelas-diampu.submission', compact('kelasList', 'dokumenKelas'));
    }

    public function upload(Request $request, DokumenKelas $dokumenKelas)
    {
        $request->validate([
            'file_dokumen' => 'required|file|mimes:pdf,doc,docx|max:2048', // Maksimal 2MB
        ]);

        // dd($request->file('file_dokumen'));

        $path = $request->file('file_dokumen')->store('dokumen_kelas', 'public');

        // dd($path);

        if ($request->hasFile('file_dokumen')) {
            if ($dokumenKelas->file_dokumen) {
                Storage::disk('public')->delete($dokumenKelas->file_dokumen);
            }
        }

        $dokumenKelas->update([
            'file_dokumen' => $path,
            'waktu_pengumpulan' => now(),
            'status' => 'dikumpulkan',
        ]);

        // dd($dokumenKelas);

        return redirect()->back()->with('success', 'Dokumen berhasil diupload.');
    }
}

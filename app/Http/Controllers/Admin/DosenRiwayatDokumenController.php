<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenRiwayatDokumenController extends Controller
{
    public function index(Request $request)
    {
        $dosenId = Auth::id();

        // Query dasar
        $query = DokumenKelas::with([
            'kelas.matkulDibuka.matkul',
            'dokumenPerkuliahan'
        ])
            ->whereHas('kelas', function ($q) use ($dosenId) {
                $q->where('dosen_id', $dosenId);
            });

        // Fitur Search
        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->whereHas('kelas', function ($kelas) use ($search) {
                    $kelas->where('nama_kelas', 'like', "%$search%");
                })
                    ->orWhereHas('kelas.matkulDibuka.matkul', function ($matkul) use ($search) {
                        $matkul->where('nama_matkul', 'like', "%$search%");
                    })
                    ->orWhereHas('dokumenPerkuliahan', function ($dok) use ($search) {
                        $dok->where('nama_dokumen', 'like', "%$search%");
                    })
                    ->orWhere('status', 'like', "%$search%");
            });
        }

        // Ambil hasil
        $riwayat = $query->orderBy('waktu_pengumpulan', 'desc')->get();

        return view('dosen.riwayat-dokumen.index', [
            'riwayat' => $riwayat,
            'search' => $request->search
        ]);
    }
}

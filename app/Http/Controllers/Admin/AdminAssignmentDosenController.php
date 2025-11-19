<?php

namespace App\Http\Controllers\Admin;

use App\Models\Matkul;
use App\Models\TahunAjaran;
use App\Models\User;
use App\Models\MatkulDibuka;
use App\Models\Kelas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAssignmentDosenController extends Controller
{
    public function stepOne()
    {
        $matkuls = Matkul::where('prodi_id', Auth::user()->prodi_id)->get();

        return view('admin.assignment-dosen.step-one', compact('matkuls'));
    }

    public function stepTwo(Request $request)
    {
        $matkul_id = $request->matkul_id ?? [];
        $jumlah_kelas = $request->jumlah_kelas ?? [];

        session([
            'matkul_id' => $matkul_id,
            'jumlah_kelas' => $jumlah_kelas
        ]);

        // dd([$matkul_id, $jumlah_kelas]);
        $matkul = Matkul::whereIn('id', $matkul_id)->get();

        $dosen = [];

        foreach ($matkul as $m) {
            $dosen[$m->id] = User::role('dosen')
                ->where('prodi_id', $m->prodi_id)
                ->get();
        }

        return view('admin.assignment-dosen.step-two', compact(
            'matkul',
            'jumlah_kelas',
            'dosen'
        ));
    }

    public function submitStepOneAndTwo(Request $request)
    {
        $matkul_id = session('matkul_id', []);
        $jumlah_kelas = session('jumlah_kelas', []);

        $kelas = $request->kelas;
        $tahunAjaranAktif = TahunAjaran::where('is_aktif', true)->first();

        foreach ($matkul_id as $i => $item) {

            // 1. Simpan Matkul Dibuka step 1
            $matkulDibuka = MatkulDibuka::create([
                'matkul_id'        => $item,
                'tahun_ajaran_id'  => $tahunAjaranAktif->id,
                'jumlah_kelas'     => $jumlah_kelas[$i],
            ]);

            // 2. Simpan kelas step 2
            foreach ($kelas[$item] as $dataKelas) {
                Kelas::create([
                    'nama_kelas'        => $dataKelas['nama_kelas'],
                    'dosen_id'          => $dataKelas['dosen_id'],
                    'matkul_dibuka_id'  => $matkulDibuka->id,
                    'tahun_ajaran_id'   => $tahunAjaranAktif->id,
                ]);
            }
        }

        return redirect()->route('admin.assignmentDosen.stepOne')
            ->with('success', 'Assignment dosen berhasil disimpan!');
    }
}

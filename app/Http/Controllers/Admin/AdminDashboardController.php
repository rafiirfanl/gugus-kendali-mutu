<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Matkul;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\DokumenKelas;
use App\Models\MatkulDibuka;
use App\Models\DokumenPerkuliahan;
use App\Models\TindakLanjut;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view:dashboard')->only(['index']);
    }

    public function index()
    {
        $user = Auth::user();
        $data = [];

        if ($user->hasRole('gkmf')) {
            $data = $this->gkmfData();
        } elseif ($user->hasRole('gkmp')) {
            $data = $this->gkmpData($user);
        } elseif ($user->hasRole('kaprodi')) {
            $data = $this->kaprodiData($user);
        } elseif ($user->hasRole('dosen')) {
            $data = $this->dosenData($user);
        }

        $data['user'] = $user;
        $data['activeTa'] = TahunAjaran::where('is_aktif', true)->first();

        return view('admin.dashboard', $data);
    }

    private function gkmfData()
    {
        $activeTa = TahunAjaran::where('is_aktif', true)->first();

        $totalUsers = User::count();
        $totalProdi = Prodi::count();
        $totalMatkul = Matkul::count();
        $totalKelas = $activeTa ? Kelas::where('tahun_ajaran_id', $activeTa->id)->count() : 0;
        $totalDokumen = DokumenPerkuliahan::count();

        $tlTotal = TindakLanjut::count();
        $tlSelesai = TindakLanjut::where('tindak_lanjut', '!=', null)->where('tindak_lanjut', '!=', '')->count();
        $tlPersentase = $tlTotal > 0 ? round(($tlSelesai / $tlTotal) * 100, 1) : 0;

        return compact(
            'totalUsers', 'totalProdi', 'totalMatkul', 'totalKelas', 'totalDokumen',
            'tlTotal', 'tlSelesai', 'tlPersentase'
        );
    }

    private function gkmpData($user)
    {
        $activeTa = TahunAjaran::where('is_aktif', true)->first();
        $prodiId = $user->prodi_id;

        $totalMatkul = Matkul::where('prodi_id', $prodiId)->count();
        $totalKelas = $activeTa ? Kelas::whereHas('matkulDibuka', function ($q) use ($prodiId) {
            $q->whereHas('matkul', function ($q2) use ($prodiId) {
                $q2->where('prodi_id', $prodiId);
            });
        })->where('tahun_ajaran_id', $activeTa->id)->count() : 0;

        $totalDosen = User::where('prodi_id', $prodiId)->whereHas('roles', function ($q) {
            $q->where('name', 'dosen');
        })->count();

        $kelasIds = Kelas::whereHas('matkulDibuka', function ($q) use ($prodiId) {
            $q->whereHas('matkul', function ($q2) use ($prodiId) {
                $q2->where('prodi_id', $prodiId);
            });
        })->when($activeTa, function ($q) use ($activeTa) {
            $q->where('tahun_ajaran_id', $activeTa->id);
        })->pluck('id');

        $totalDokumenKelas = DokumenKelas::whereIn('kelas_id', $kelasIds)->count();
        $dokumenTerkumpul = DokumenKelas::whereIn('kelas_id', $kelasIds)->where('status', 'dikumpulkan')->count();
        $dokumenDitolak = DokumenKelas::whereIn('kelas_id', $kelasIds)->where('status', 'ditolak')->count();
        $persentaseTerkumpul = $totalDokumenKelas > 0 ? round(($dokumenTerkumpul / $totalDokumenKelas) * 100, 1) : 0;

        $tlTotal = TindakLanjut::where('prodi_id', $prodiId)->count();
        $tlSelesai = TindakLanjut::where('prodi_id', $prodiId)->where('tindak_lanjut', '!=', null)->where('tindak_lanjut', '!=', '')->count();
        $tlPersentase = $tlTotal > 0 ? round(($tlSelesai / $tlTotal) * 100, 1) : 0;

        $kelasList = Kelas::with(['matkulDibuka.matkul', 'dosen', 'dokumenKelas'])
            ->whereHas('matkulDibuka', function ($q) use ($prodiId) {
                $q->whereHas('matkul', function ($q2) use ($prodiId) {
                    $q2->where('prodi_id', $prodiId);
                });
            })
            ->when($activeTa, function ($q) use ($activeTa) {
                $q->where('tahun_ajaran_id', $activeTa->id);
            })
            ->get()
            ->map(function ($kelas) {
                $total = $kelas->dokumenKelas->count();
                $terkumpul = $kelas->dokumenKelas->where('status', 'dikumpulkan')->count();
                return [
                    'id' => $kelas->id,
                    'nama' => $kelas->nama_kelas,
                    'matkul' => $kelas->matkulDibuka->matkul->nama_matkul ?? '-',
                    'dosen' => $kelas->dosen->name ?? '-',
                    'total' => $total,
                    'terkumpul' => $terkumpul,
                    'persentase' => $total > 0 ? round(($terkumpul / $total) * 100, 1) : 0,
                ];
            });

        $dokumenPending = $dokumenDitolak;

        return compact(
            'totalMatkul', 'totalKelas', 'totalDosen',
            'totalDokumenKelas', 'dokumenTerkumpul', 'dokumenDitolak', 'dokumenPending', 'persentaseTerkumpul',
            'tlTotal', 'tlSelesai', 'tlPersentase', 'kelasList'
        );
    }

    private function kaprodiData($user)
    {
        $activeTa = TahunAjaran::where('is_aktif', true)->first();
        $prodiId = $user->prodi_id;

        $totalMatkul = Matkul::where('prodi_id', $prodiId)->count();
        $totalDosen = User::where('prodi_id', $prodiId)->whereHas('roles', function ($q) {
            $q->where('name', 'dosen');
        })->count();

        $kelasIds = Kelas::whereHas('matkulDibuka', function ($q) use ($prodiId) {
            $q->whereHas('matkul', function ($q2) use ($prodiId) {
                $q2->where('prodi_id', $prodiId);
            });
        })->when($activeTa, function ($q) use ($activeTa) {
            $q->where('tahun_ajaran_id', $activeTa->id);
        })->pluck('id');

        $totalKelas = $kelasIds->count();
        $totalDokumenKelas = DokumenKelas::whereIn('kelas_id', $kelasIds)->count();
        $dokumenTerkumpul = DokumenKelas::whereIn('kelas_id', $kelasIds)->where('status', 'dikumpulkan')->count();
        $persentaseTerkumpul = $totalDokumenKelas > 0 ? round(($dokumenTerkumpul / $totalDokumenKelas) * 100, 1) : 0;

        $dokumenPerSesi = [];
        for ($sesi = 1; $sesi <= 4; $sesi++) {
            $dokumenIds = DokumenPerkuliahan::where('sesi', $sesi)->pluck('id');
            $total = DokumenKelas::whereIn('kelas_id', $kelasIds)->whereIn('dokumen_perkuliahan_id', $dokumenIds)->count();
            $terkumpul = DokumenKelas::whereIn('kelas_id', $kelasIds)->whereIn('dokumen_perkuliahan_id', $dokumenIds)->where('status', 'dikumpulkan')->count();
            $dokumenPerSesi[$sesi] = [
                'total' => $total,
                'terkumpul' => $terkumpul,
                'persentase' => $total > 0 ? round(($terkumpul / $total) * 100, 1) : 0,
            ];
        }

        $kelasList = Kelas::with(['matkulDibuka.matkul', 'dosen', 'dokumenKelas'])
            ->whereHas('matkulDibuka', function ($q) use ($prodiId) {
                $q->whereHas('matkul', function ($q2) use ($prodiId) {
                    $q2->where('prodi_id', $prodiId);
                });
            })
            ->when($activeTa, function ($q) use ($activeTa) {
                $q->where('tahun_ajaran_id', $activeTa->id);
            })
            ->get()
            ->map(function ($kelas) {
                $total = $kelas->dokumenKelas->count();
                $terkumpul = $kelas->dokumenKelas->where('status', 'dikumpulkan')->count();
                return [
                    'id' => $kelas->id,
                    'nama' => $kelas->nama_kelas,
                    'matkul' => $kelas->matkulDibuka->matkul->nama_matkul ?? '-',
                    'dosen' => $kelas->dosen->name ?? '-',
                    'total' => $total,
                    'terkumpul' => $terkumpul,
                    'persentase' => $total > 0 ? round(($terkumpul / $total) * 100, 1) : 0,
                ];
            });

        return compact(
            'totalMatkul', 'totalDosen', 'totalKelas',
            'totalDokumenKelas', 'dokumenTerkumpul', 'persentaseTerkumpul',
            'dokumenPerSesi', 'kelasList'
        );
    }

    private function dosenData($user)
    {
        $activeTa = TahunAjaran::where('is_aktif', true)->first();

        $kelasQuery = Kelas::with(['matkulDibuka.matkul', 'dokumenKelas.dokumenPerkuliahan'])
            ->where('dosen_id', $user->id);

        if ($activeTa) {
            $kelasQuery->where('tahun_ajaran_id', $activeTa->id);
        }

        $kelasList = $kelasQuery->get()->map(function ($kelas) {
            $total = $kelas->dokumenKelas->count();
            $terkumpul = $kelas->dokumenKelas->where('status', 'dikumpulkan')->count();
            $pending = $kelas->dokumenKelas->where('status', 'ditolak')->count();
            return [
                'id' => $kelas->id,
                'nama' => $kelas->nama_kelas,
                'matkul' => $kelas->matkulDibuka->matkul->nama_matkul ?? '-',
                'total' => $total,
                'terkumpul' => $terkumpul,
                'pending' => $pending,
                'persentase' => $total > 0 ? round(($terkumpul / $total) * 100, 1) : 0,
            ];
        });

        $totalKelas = $kelasList->count();
        $totalDokumen = DokumenKelas::whereHas('kelas', function ($q) use ($user, $activeTa) {
            $q->where('dosen_id', $user->id);
            if ($activeTa) {
                $q->where('tahun_ajaran_id', $activeTa->id);
            }
        })->count();
        $dokumenTerkumpul = DokumenKelas::whereHas('kelas', function ($q) use ($user, $activeTa) {
            $q->where('dosen_id', $user->id);
            if ($activeTa) {
                $q->where('tahun_ajaran_id', $activeTa->id);
            }
        })->where('status', 'dikumpulkan')->count();
        $dokumenPending = DokumenKelas::whereHas('kelas', function ($q) use ($user, $activeTa) {
            $q->where('dosen_id', $user->id);
            if ($activeTa) {
                $q->where('tahun_ajaran_id', $activeTa->id);
            }
        })->where('status', 'ditolak')->count();
        $persentaseTerkumpul = $totalDokumen > 0 ? round(($dokumenTerkumpul / $totalDokumen) * 100, 1) : 0;

        return compact(
            'totalKelas', 'totalDokumen', 'dokumenTerkumpul', 'dokumenPending',
            'persentaseTerkumpul', 'kelasList'
        );
    }
}

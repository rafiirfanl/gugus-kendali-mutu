@extends('layouts.admin.app')

@section('title', 'Pemeringkatan Dosen')

@section('content')
    <section class="content">

        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-trophy"></i> Pemeringkatan Dosen — Kepatuhan Dokumen Perkuliahan</h5>
                <form action="{{ route('gkmp.pemeringkatanDosen.index') }}" method="GET" class="d-flex" style="gap:8px;flex-wrap:wrap;">
                    <select name="tahun_ajaran" class="form-select" style="width:200px;font-size:0.85rem;">
                        @foreach ($tahunAjaranList as $ta)
                            <option value="{{ $ta->id }}" {{ $tahunAjaran && $tahunAjaran->id === $ta->id ? 'selected' : '' }}>
                                {{ $ta->tahun_ajaran }} — {{ $ta->jenis }}{{ $ta->is_aktif ? ' (Aktif)' : '' }}
                            </option>
                        @endforeach
                    </select>
                    @if ($prodiList->isNotEmpty())
                        <select name="prodi" class="form-select" style="width:200px;font-size:0.85rem;">
                            <option value="">Semua Prodi</option>
                            @foreach ($prodiList as $prodi)
                                <option value="{{ $prodi->id }}" {{ $prodiId === $prodi->id ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                    <button class="btn-crud btn-crud-primary btn-crud-sm" type="submit"><i class="fas fa-filter mr-1"></i> Terapkan</button>
                    @if (request()->filled('tahun_ajaran') || request()->filled('prodi'))
                        <a href="{{ route('gkmp.pemeringkatanDosen.index') }}" class="btn-crud btn-crud-secondary btn-crud-sm"><i class="fas fa-times mr-1"></i> Reset</a>
                    @endif
                </form>
            </div>
            <div class="crud-card-body">
                @if (!$tahunAjaran)
                    <div class="empty-state">
                        <i class="fas fa-calendar-times d-block"></i>
                        <p>Belum ada Tahun Ajaran tersedia.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="crud-table">
                            <thead>
                                <tr>
                                    <th class="text-center" width="70">Rank</th>
                                    <th>Dosen</th>
                                    <th class="text-center" width="150">NIP</th>
                                    <th>Program Studi</th>
                                    <th class="text-center" width="80">Score</th>
                                    <th class="text-center" width="120">Ketepatan Waktu</th>
                                    <th class="text-center" width="90">Terkumpul</th>
                                    <th class="text-center" width="90">Terlambat</th>
                                    <th class="text-center" width="130">Tidak Terkumpul</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($leaderboard as $row)
                                    <tr>
                                        <td class="text-center">
                                            @if ($row['rank'] <= 3)
                                                <span class="badge-crud badge-crud-warning" style="font-size:0.85rem;">{{ $row['rank'] }}</span>
                                            @else
                                                <span class="badge-crud badge-crud-secondary" style="font-size:0.85rem;">{{ $row['rank'] }}</span>
                                            @endif
                                        </td>
                                        <td class="cell-bold">{{ $row['dosen']->name }}</td>
                                        <td class="text-center">{{ $row['dosen']->nip ?? '-' }}</td>
                                        <td>{{ $row['prodi'] }}</td>
                                        <td class="text-center"><strong>{{ number_format($row['score'], 1) }}</strong></td>
                                        <td class="text-center">{{ $row['on_time_rate'] }}%</td>
                                        <td class="text-center"><span class="badge-crud badge-crud-success">{{ $row['tepat_waktu'] }}</span></td>
                                        <td class="text-center"><span class="badge-crud badge-crud-warning">{{ $row['terlambat'] }}</span></td>
                                        <td class="text-center"><span class="badge-crud badge-crud-danger">{{ $row['tidak_terkumpul'] }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">
                                            <div class="empty-state">
                                                <i class="fas fa-inbox d-block"></i>
                                                <p>Belum ada data pemeringkatan untuk tahun ajaran ini.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

    </section>
@endsection

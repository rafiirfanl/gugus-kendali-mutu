@extends('layouts.admin.app')

@section('title', 'Kelas Diampu')

@section('content')
<section class="content">
    <div class="crud-card">
        <div class="crud-card-header">
            <h5><i class="fas fa-chalkboard"></i> Kelas Diampu</h5>
            <span class="badge-crud badge-crud-info">TA {{ $tahunAktif->tahun_ajaran ?? '-' }}</span>
        </div>
        <div class="crud-card-body">
            <div class="table-responsive">
                <table class="crud-table">
                    <thead>
                        <tr>
                            <th class="text-center" width="60">No</th>
                            <th>Nama Kelas</th>
                            <th>Mata Kuliah</th>
                            <th class="text-center" width="80">SKS</th>
                            <th class="text-center" width="100">Praktikum</th>
                            <th class="text-center" width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kelas as $k)
                            <tr>
                                <td class="text-center"><span class="row-num">{{ $loop->iteration }}</span></td>
                                <td class="cell-bold">{{ $k->nama_kelas }}</td>
                                <td>{{ $k->matkulDibuka->matkul->nama_matkul ?? '-' }}</td>
                                <td class="text-center">{{ $k->matkulDibuka->matkul->bobot_sks ?? '-' }}</td>
                                <td class="text-center">
                                    @if ($k->matkulDibuka->matkul->praktikum ?? 0)
                                        <span class="badge-crud badge-crud-success">Ya</span>
                                    @else
                                        <span class="badge-crud badge-crud-secondary">Tidak</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('dosen.kelasDiampu.show', $k->id) }}" class="btn-crud btn-crud-primary btn-crud-sm"><i class="fas fa-eye mr-1"></i> Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="fas fa-chalkboard d-block"></i>
                                        <p>Belum ada kelas diampu.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

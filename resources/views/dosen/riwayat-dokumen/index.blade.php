@extends('layouts.admin.app')

@section('title', 'Riwayat Dokumen')

@section('content')
    <section class="content">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-history"></i> Riwayat Pengumpulan Dokumen</h5>
                <form action="" method="GET" class="d-flex" style="gap:8px;">
                    <input type="text" name="search" class="form-crud" placeholder="Cari kelas / mata kuliah / dokumen..." value="{{ $search ?? '' }}" style="width:260px;font-size:0.85rem;">
                    <button class="btn-crud btn-crud-primary btn-crud-sm" type="submit"><i class="fas fa-search mr-1"></i> Cari</button>
                    @if (request()->search)
                        <a href="{{ route('dosen.riwayatDokumen.index') }}" class="btn-crud btn-crud-secondary btn-crud-sm"><i class="fas fa-times mr-1"></i> Reset</a>
                    @endif
                </form>
            </div>
            <div class="crud-card-body">
                <div class="table-responsive">
                    <table class="crud-table">
                        <thead>
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th>Kelas</th>
                                <th>Mata Kuliah</th>
                                <th>Dokumen</th>
                                <th class="text-center" width="160">Waktu Pengumpulan</th>
                                <th class="text-center" width="120">Status</th>
                                <th class="text-center" width="100">File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayat as $item)
                                <tr>
                                    <td class="text-center"><span class="row-num">{{ $loop->iteration }}</span></td>
                                    <td class="cell-bold">{{ $item->kelas->nama_kelas }}</td>
                                    <td>{{ $item->kelas->matkulDibuka->matkul->nama_matkul ?? '-' }}</td>
                                    <td>{{ $item->dokumenPerkuliahan->nama_dokumen }}</td>
                                    <td class="text-center" style="font-size:0.85rem;">
                                        {{ $item->waktu_pengumpulan ? \Carbon\Carbon::parse($item->waktu_pengumpulan)->format('d M Y H:i') : '-' }}
                                    </td>
                                    <td class="text-center">
                                        @if ($item->status === 'dikumpulkan')
                                            <span class="badge-crud badge-crud-success">Dikumpulkan</span>
                                        @elseif($item->status === 'telat')
                                            <span class="badge-crud badge-crud-warning">Terlambat</span>
                                        @else
                                            <span class="badge-crud badge-crud-secondary">{{ ucfirst($item->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($item->file_dokumen)
                                            <a href="{{ asset('storage/' . $item->file_dokumen) }}" class="btn-crud btn-crud-primary btn-crud-sm" target="_blank"><i class="fas fa-eye mr-1"></i> Lihat</a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox d-block"></i>
                                            <p>Belum ada riwayat pengumpulan dokumen.</p>
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

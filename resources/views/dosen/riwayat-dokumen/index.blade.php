@extends('layouts.admin.app')

@section('title', 'Riwayat Dokumen')

@section('content')
    <section class="content">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">

            {{-- HEADER + SEARCH --}}
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Riwayat Pengumpulan Dokumen</h3>

                <form action="" method="GET" class="d-flex" style="gap: 10px;">
                    <input type="text" name="search" class="form-control"
                        placeholder="Cari kelas / mata kuliah / dokumen / status..." value="{{ $search ?? '' }}"
                        style="width: 300px">

                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>

                    @if (request()->search)
                        <a href="{{ route('dosen.riwayatDokumen.index') }}" class="btn btn-secondary">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            {{-- TABLE --}}
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Mata Kuliah</th>
                            <th>Dokumen</th>
                            <th>Waktu Pengumpulan</th>
                            <th>Status</th>
                            <th>File</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($riwayat as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>

                                <td>{{ $item->kelas->nama_kelas }}</td>

                                <td>{{ $item->kelas->matkulDibuka->matkul->nama_matkul ?? '-' }}</td>

                                <td>{{ $item->dokumenPerkuliahan->nama_dokumen }}</td>

                                <td class="text-center">
                                    {{ $item->waktu_pengumpulan ? \Carbon\Carbon::parse($item->waktu_pengumpulan)->format('d M Y H:i') : '-' }}
                                </td>

                                <td class="text-center">
                                    @if ($item->status === 'dikumpulkan')
                                        <span class="badge bg-success">Dikumpulkan</span>
                                    @elseif($item->status === 'telat')
                                        <span class="badge bg-warning">Terlambat</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if ($item->file_dokumen)
                                        <a href="{{ asset('storage/' . $item->file_dokumen) }}" class="btn btn-sm btn-primary"
                                            target="_blank">
                                            Lihat
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Belum ada riwayat pengumpulan dokumen.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>

    </section>
@endsection

@extends('layouts.admin.app')

@section('title', 'Submission Dokumen')

@section('content')
<section class="content">

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <h5 class="mb-4" style="font-weight:700;color:#0c3366;"><i class="fas fa-upload mr-2"></i> Submission Dokumen Perkuliahan</h5>

    @foreach ($kelasList as $kelas)
        <div class="crud-card mb-4">
            <div class="crud-card-header">
                <h5><i class="fas fa-book mr-2"></i> {{ $kelas->matkulDibuka->matkul->nama_matkul }} — {{ $kelas->nama_kelas }}</h5>
            </div>
            <div class="crud-card-body">
                <div class="table-responsive">
                    <table class="crud-table">
                        <thead>
                            <tr>
                                <th>Nama Dokumen</th>
                                <th class="text-center" width="140">Status</th>
                                <th class="text-center" width="120">File</th>
                                <th>Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dokumenKelas as $dok)
                                @php
                                    $existing = $kelas->dokumenKelas->where('dokumen_perkuliahan_id', $dok->id)->first();
                                @endphp
                                <tr>
                                    <td>{{ $dok->dokumenPerkuliahan->nama_dokumen }}</td>
                                    <td class="text-center">
                                        @if ($existing && $existing->file_dokumen)
                                            <span class="badge-crud badge-crud-success">Sudah Upload</span>
                                        @else
                                            <span class="badge-crud badge-crud-warning">Belum Upload</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($existing && $existing->file_dokumen)
                                            <a href="{{ asset('storage/' . $existing->file_dokumen) }}" target="_blank" class="btn-crud btn-crud-info btn-crud-sm"><i class="fas fa-eye mr-1"></i> Lihat</a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            if (!$existing) {
                                                $existing = \App\Models\DokumenKelas::create([
                                                    'kelas_id' => $kelas->id,
                                                    'dokumen_perkuliahan_id' => $dok->id,
                                                ]);
                                            }
                                        @endphp
                                        <form action="{{ route('dosen.kelasDiampu.upload', $existing->id) }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2 align-items-start">
                                            @csrf
                                            <input type="file" name="file_dokumen" class="form-control form-crud" required style="font-size:0.82rem;">
                                            <button class="btn-crud btn-crud-primary btn-crud-sm"><i class="fas fa-upload mr-1"></i> Upload</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach

</section>
@endsection

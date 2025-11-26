@extends('layouts.admin.app')

@section('title', 'Submission Dokumen')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4">Submission Dokumen Perkuliahan</h4>

    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @foreach ($kelasList as $kelas)
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                {{ $kelas->matkulDibuka->matkul->nama_matkul }} — {{ $kelas->nama_kelas }}
            </div>

            <div class="card-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Dokumen</th>
                            <th>Status</th>
                            <th>Lihat File</th>
                            <th>Upload</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($dokumenKelas as $dok)
                            @php
                                $existing = $kelas->dokumenKelas
                                    ->where('dokumen_perkuliahan_id', $dok->id)
                                    ->first();
                            @endphp

                            <tr>
                                <td>{{ $dok->dokumenPerkuliahan->nama_dokumen }}</td>

                                <td>
                                    @if ($existing && $existing->file_dokumen)
                                        <span class="badge bg-success">Sudah Upload</span>
                                    @else
                                        <span class="badge bg-danger">Belum Upload</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($existing && $existing->file_dokumen)
                                        <a href="{{ asset('storage/' . $existing->file_dokumen) }}" target="_blank">
                                            Lihat File
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    @php
                                        // Jika belum ada record dokumen_kelas → buat otomatis
                                        if (!$existing) {
                                            $existing = \App\Models\DokumenKelas::create([
                                                'kelas_id' => $kelas->id,
                                                'dokumen_perkuliahan_id' => $dok->id,
                                            ]);
                                        }
                                    @endphp

                                    <form action="{{ route('dosen.kelasDiampu.upload', $existing->id) }}" 
                                          method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <input type="file" name="file_dokumen" class="form-control mb-2" required>
                                        <button class="btn btn-primary btn-sm">Upload</button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    @endforeach

</div>
@endsection

@extends('layouts.admin.app')

@section('title', 'Dokumen Perkuliahan')

@section('content')
    <section class="content">
        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-file-alt"></i> Data Dokumen Perkuliahan</h5>
                @can('create:dokumen-perkuliahan')
                    @include('admin.dokumen-perkuliahan.create')
                @endcan
            </div>
            <div class="crud-card-body">
                <div class="table-responsive">
                    <table class="crud-table">
                        <thead>
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th>Nama Dokumen</th>
                                <th class="text-center">Sesi</th>
                                <th class="text-center">Tenggat (Minggu)</th>
                                <th class="text-center">Template</th>
                                <th class="text-center" width="140">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dokumenPerkuliahans as $dokumenPerkuliahan)
                                <tr>
                                    <td class="text-center"><span class="row-num">{{ $loop->iteration }}</span></td>
                                    <td class="cell-bold">{{ $dokumenPerkuliahan->nama_dokumen }}</td>
                                    <td class="text-center"><span class="badge-crud badge-crud-primary">Sesi {{ $dokumenPerkuliahan->sesi }}</span></td>
                                    <td class="text-center">Minggu {{ $dokumenPerkuliahan->tenggat_waktu_default }}</td>
                                    <td class="text-center">
                                        @if ($dokumenPerkuliahan->template)
                                            <a href="{{ Storage::disk('public')->url($dokumenPerkuliahan->template) }}" target="_blank" class="btn-crud btn-crud-info btn-crud-sm" style="text-decoration:none;">
                                                <i class="fas fa-external-link-alt"></i> Lihat
                                            </a>
                                        @else
                                            <span class="badge-crud badge-crud-warning">Tidak Ada</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            @can('edit:dokumen-perkuliahan')
                                                @include('admin.dokumen-perkuliahan.edit')
                                            @endcan
                                            @can('delete:dokumen-perkuliahan')
                                                @include('admin.dokumen-perkuliahan.delete')
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

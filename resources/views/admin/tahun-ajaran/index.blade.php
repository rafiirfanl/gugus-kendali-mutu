@extends('layouts.admin.app')

@section('title', 'Tahun Ajaran')

@section('content')
    <section class="content">
        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-calendar"></i> Data Tahun Ajaran</h5>
                @can('create:tahun-ajaran')
                    @include('admin.tahun-ajaran.create')
                @endcan
            </div>
            <div class="crud-card-body">
                <div class="table-responsive">
                    <table class="crud-table">
                        <thead>
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th>Tahun Ajaran</th>
                                <th>Jenis</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" width="140">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tahunAjarans as $tahunAjaran)
                                <tr>
                                    <td class="text-center"><span class="row-num">{{ $loop->iteration }}</span></td>
                                    <td class="cell-bold">{{ $tahunAjaran->tahun_ajaran ?? '-' }}</td>
                                    <td><span class="badge-crud badge-crud-info">{{ $tahunAjaran->jenis ?? '-' }}</span></td>
                                    <td class="text-center">
                                        @if ($tahunAjaran->is_aktif)
                                            <span class="badge-crud badge-crud-success">Aktif</span>
                                        @else
                                            <span class="badge-crud badge-crud-warning">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            @can('edit:tahun-ajaran')
                                                @include('admin.tahun-ajaran.edit')
                                            @endcan
                                            @can('delete:tahun-ajaran')
                                                @include('admin.tahun-ajaran.delete')
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

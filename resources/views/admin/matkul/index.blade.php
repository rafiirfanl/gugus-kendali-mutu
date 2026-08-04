@extends('layouts.admin.app')

@section('title', 'Mata Kuliah Management')

@section('content')
    <section class="content">
        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-book"></i> Data Mata Kuliah</h5>
                @can('create:matkul')
                    @include('admin.matkul.create')
                @endcan
            </div>
            <div class="crud-card-body">
                <div class="table-responsive">
                    <table class="crud-table">
                        <thead>
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th>Nama Mata Kuliah</th>
                                <th>Kode Mata Kuliah</th>
                                <th class="text-center">Bobot SKS</th>
                                <th class="text-center">Praktikum</th>
                                <th class="text-center" width="140">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matkuls as $matkul)
                                <tr>
                                    <td class="text-center"><span class="row-num">{{ $loop->iteration }}</span></td>
                                    <td class="cell-bold">{{ $matkul->nama_matkul ?? '-' }}</td>
                                    <td><span class="badge-crud badge-crud-info">{{ $matkul->kode_matkul ?? '-' }}</span></td>
                                    <td class="text-center">{{ $matkul->bobot_sks ?? '-' }}</td>
                                    <td class="text-center">
                                        @if($matkul->praktikum)
                                            <span class="badge-crud badge-crud-success">Ya</span>
                                        @else
                                            <span class="badge-crud badge-crud-warning">Tidak</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            @can('edit:matkul')
                                                @include('admin.matkul.edit')
                                            @endcan
                                            @can('delete:matkul')
                                                @include('admin.matkul.delete')
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

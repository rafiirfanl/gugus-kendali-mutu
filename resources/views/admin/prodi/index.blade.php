@extends('layouts.admin.app')

@section('title', 'Prodi Management')

@section('content')
    <section class="content">
        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-university"></i> Data Program Studi</h5>
                @can('create:prodi')
                    @include('admin.prodi.create')
                @endcan
            </div>
            <div class="crud-card-body">
                <div class="table-responsive">
                    <table class="crud-table">
                        <thead>
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th>Program Studi</th>
                                <th>Kode Prodi</th>
                                <th class="text-center" width="140">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prodis as $prodi)
                                <tr>
                                    <td class="text-center"><span class="row-num">{{ $loop->iteration }}</span></td>
                                    <td class="cell-bold">{{ $prodi->nama_prodi ?? '-' }}</td>
                                    <td><span class="badge-crud badge-crud-info">{{ $prodi->kode_prodi ?? '-' }}</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            @can('edit:prodi')
                                                @include('admin.prodi.edit')
                                            @endcan
                                            @can('delete:prodi')
                                                @include('admin.prodi.delete')
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

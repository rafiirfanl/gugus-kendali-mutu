@extends('layouts.admin.app')
@section('title', 'Data Temuan')

@section('content')
    <section class="content">
        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-folder-open"></i> Daftar Kriteria</h5>
                <a href="{{ route('admin.temuan.create') }}" class="btn-crud btn-crud-primary btn-crud-sm">
                    <i class="fas fa-plus mr-1"></i> Tambah Kriteria
                </a>
            </div>
            <div class="crud-card-body">
                <div class="table-responsive">
                    <table class="crud-table">
                        <thead>
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th>Nama Kriteria</th>
                                <th>Subkriteria</th>
                                <th class="text-center" width="180">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kriteria as $i => $k)
                                <tr>
                                    <td class="text-center"><span class="row-num">{{ $i + 1 }}</span></td>
                                    <td class="cell-bold">{{ $k->nama }}</td>
                                    <td>
                                        @forelse ($k->subkriterias as $sub)
                                            <span class="badge-crud badge-crud-info">{{ $sub->kode }}</span>
                                        @empty
                                            <span class="badge-crud badge-crud-warning">Belum ada</span>
                                        @endforelse
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('admin.temuan.show', $k->id) }}" class="btn-crud btn-crud-info btn-crud-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                            @can('edit:kriteria')
                                                @include('admin.data-temuan.kriteria.edit', ['kriteria' => $k])
                                            @endcan
                                            @can('delete:kriteria')
                                                @include('admin.data-temuan.kriteria.delete', ['kriteria' => $k])
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

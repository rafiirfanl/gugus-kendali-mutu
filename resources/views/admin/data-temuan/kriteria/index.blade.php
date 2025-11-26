@extends('layouts.admin.app')
@section('title', 'Data Temuan & Tindak Lanjut')

@section('content')
    <div class="container">

        <a href="{{ route('admin.temuan.create') }}" class="btn btn-primary mb-3">
            <i class="fa fa-plus"></i> Tambah Kriteria
        </a>

        <div class="card">
            <div class="card-header bg-primary text-white">Daftar Kriteria</div>
            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kriteria</th>
                            <th>Subkriteria</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($kriteria as $i => $k)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $k->nama }}</td>
                                <td>
                                    @forelse ($k->subkriteria as $sub)
                                        <span class="badge bg-secondary">{{ $sub->kode }}</span>
                                    @empty
                                        <span class="text-muted">Belum ada</span>
                                    @endforelse
                                </td>

                                <td>
                                    <a href="{{ route('admin.temuan.show', $k->id) }}" class="btn btn-info btn-sm">
                                        Detail
                                    </a>
                                    @can('edit:kriteria')
                                        @include('admin.data-temuan.kriteria.edit', ['kriteria' => $k])
                                    @endcan
                                    @csrf @method('DELETE')
                                    @can('delete:kriteria')
                                        @include('admin.data-temuan.kriteria.delete', ['kriteria' => $k])
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>

    </div>
@endsection

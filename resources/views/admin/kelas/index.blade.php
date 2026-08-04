@extends('layouts.admin.app')

@section('title', 'Kelas Management')

@section('content')
    <section class="content">
        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-door-open"></i> Data Kelas</h5>
                @can('create:kelas')
                    @include('admin.kelas.create')
                @endcan
            </div>
            <div class="crud-card-body">
                <div class="table-responsive">
                    <table class="crud-table">
                        <thead>
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th>Nama Kelas</th>
                                <th>Mata Kuliah</th>
                                <th class="text-center" width="140">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelases as $kelas)
                                <tr>
                                    <td class="text-center"><span class="row-num">{{ $loop->iteration }}</span></td>
                                    <td class="cell-bold">{{ $kelas->nama_kelas ?? '-' }}</td>
                                    <td>{{ $kelas->matkul->nama_matkul ?? '-' }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            @can('edit:kelas')
                                                @include('admin.kelas.edit')
                                            @endcan
                                            @can('delete:kelas')
                                                @include('admin.kelas.delete')
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

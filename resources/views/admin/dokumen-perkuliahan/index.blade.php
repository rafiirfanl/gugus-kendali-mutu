@extends('layouts.admin.app')

@section('title', 'Dokumen Perkuliahan')

@section('content')
    <!-- Main content -->
    <section class="content">
        @can('create:dokumen-perkuliahan')
            @include('admin.dokumen-perkuliahan.create')
        @endcan
        <!-- Table -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Nama Dokumen Perkuliahan</th>
                    <th class="text-center">Sesi</th>
                    <th class="text-center">Minggu Tenggat Waktu</th>
                    <th class="text-center">Dikumpulkan Per</th>
                    <th class="text-center">Template</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dokumenPerkuliahans as $dokumenPerkuliahan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dokumenPerkuliahan->nama_dokumen }}</td>
                        <td>{{ $dokumenPerkuliahan->sesi }}</td>
                        <td>{{ $dokumenPerkuliahan->tenggat_waktu_default }}</td>
                        <td>
                            @if ($dokumenPerkuliahan->template)
                                <a href="{{ Storage::disk('public')->url($dokumenPerkuliahan->template) }}" target="_blank">Lihat Dokumen</a>
                            @else
                                Tidak Ada Dokumen
                            @endif
                        </td>
                        <td class="text-center">
                            @can('edit:dokumen-perkuliahan')
                                @include('admin.dokumen-perkuliahan.edit')
                            @endcan
                            @can('delete:dokumen-perkuliahan')
                                @include('admin.dokumen-perkuliahan.delete')
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <!-- /.content -->
@endsection

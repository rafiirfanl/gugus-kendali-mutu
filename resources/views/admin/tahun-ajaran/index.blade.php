@extends('layouts.admin.app')

@section('title', 'Tahun Ajaran')

@section('content')
    <!-- Main content -->
    <section class="content">
        @can('create:tahun-ajaran')
            @include('admin.tahun-ajaran.create')
        @endcan
        <!-- Table -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{ __('No') }}</th>
                    <th>{{ __('Tahun Ajaran') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th class="text-center">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tahunAjarans as $tahunAjaran)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tahunAjaran->tahun_ajaran ?? '-' }}</td>
                        <td>{{ $tahunAjaran->is_aktif ? 'Aktif' : 'Tidak Aktif' }}</td>
                        <td class="text-center"> 
                            @can('edit:tahun-ajaran')
                                @include('admin.tahun-ajaran.edit')
                            @endcan
                            @can('delete:tahun-ajaran')
                                @include('admin.tahun-ajaran.delete')
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <!-- /.content -->
@endsection

@extends('layouts.admin.app')

@section('title', 'Kelas Management')

@section('content')
    <!-- Main content -->
    <section class="content">
        @can('create:kelas')
            @include('admin.kelas.create')
        @endcan
        <!-- Table -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{ __('No') }}</th>
                    <th>{{ __('Class Name') }}</th>
                    <th>{{ __('Offered Course') }}</th>
                    <th class="text-center">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelases as $kelas)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $kelas->nama_kelas ?? '-' }}</td>
                        <td>{{ $kelas->matkul->nama_matkul ?? '-' }}</td>
                        <td class="text-center">
                            @can('edit:kelas')
                                @include('admin.kelas.edit')
                            @endcan
                            @can('delete:kelas')
                                @include('admin.kelas.delete')
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <!-- /.content -->
@endsection

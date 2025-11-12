@extends('layouts.admin.app')

@section('title', 'Kelas Management')

@section('content')
    <!-- Main content -->
    <section class="content">
        @include('admin.kelas.create')
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
                            @include('admin.kelas.edit')
                            @include('admin.kelas.delete')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <!-- /.content -->
@endsection

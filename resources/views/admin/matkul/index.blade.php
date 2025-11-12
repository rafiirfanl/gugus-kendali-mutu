@extends('layouts.admin.app')

@section('title', 'Mata Kuliah Management')

@section('content')
    <!-- Main content -->
    <section class="content">
        @include('admin.matkul.create')
        <!-- Table -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{ __('No') }}</th>
                    <th>{{ __('Nama Mata Kuliah') }}</th>
                    <th>{{ __('Kode Mata Kuliah') }}</th>
                    <th>{{ __('Bobot SKS') }}</th>
                    <th>{{ __('Praktikum') }}</th>
                    <th class="text-center">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matkuls as $matkul)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $matkul->nama_matkul ?? '-' }}</td>
                        <td>{{ $matkul->kode_matkul ?? '-' }}</td>
                        <td class="text-center">{{ $matkul->bobot_sks ?? '-' }}</td>
                        <td class="text-center">{{ $matkul->praktikum ?? '-' }}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                            @include('admin.matkul.delete')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <!-- /.content -->
@endsection

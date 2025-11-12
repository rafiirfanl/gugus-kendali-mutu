@extends('layouts.admin.app')

@section('title', 'Mata Kuliah Management')

@section('content')
    <!-- Main content -->
    <section class="content">
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
                @foreach ($matkul as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_matkul ?? '-' }}</td>
                        <td>{{ $item->kode_matkul ?? '-' }}</td>
                        <td class="text-center">{{ $item->bobot_sks ?? '-' }}</td>
                        <td class="text-center">{{ $item->praktikum ?? '-' }}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <!-- /.content -->
@endsection

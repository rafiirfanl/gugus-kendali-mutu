@extends('layouts.admin.app')

@section('title', 'Prodi Management')

@section('content')
    <!-- Main content -->
    <section class="content">
        @include('admin.prodi.create')
        <!-- Table -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{ __('No') }}</th>
                    <th>{{ __('Program Studi') }}</th>
                    <th>{{ __('Kode Program Studi') }}</th>
                    <th class="text-center">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prodis as $prodi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $prodi->nama_prodi ?? '-' }}</td>
                        <td>{{ $prodi->kode_prodi ?? '-' }}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                            @include('admin.prodi.delete')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <!-- /.content -->
@endsection

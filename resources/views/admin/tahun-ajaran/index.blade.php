@extends('layouts.admin.app')

@section('title', 'Tahun Ajaran')

@section('content')
    <!-- Main content -->
    <section class="content">
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
                @foreach ($tahunAjaran as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tahun_ajaran ?? '-' }}</td>
                        <td>{{ $item->is_aktif ? 'Aktif' : 'Tidak Aktif' }}</td>
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

@extends('layouts.admin.app')

@section('title', 'Kelas Management')

@section('content')
    <!-- Main content -->
    <section class="content">
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
                @foreach ($kelas as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_kelas ?? '-' }}</td>
                        <td>{{ $item->matkul->nama_matkul ?? '-' }}</td>
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

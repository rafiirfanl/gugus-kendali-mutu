@extends('layouts.admin.app')

@section('title', 'Data Temuan')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Table -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{ __('No') }}</th>
                    <th>{{ __('Data Temuan') }}</th>
                    <th>{{ __('Status Tahun Lalu') }}</th>
                    <th>{{ __('Status Tahun Ini') }}</th>
                    <th>{{ __('Kendala') }}</th>
                    <th>{{ __('Tindak Lanjut') }}</th>
                    <th>{{ __('Masukkan') }}</th>
                    <th class="text-center">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataTemuans as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">
                            {{ $item->hasil_temuan ?? '-' }}
                        </td>
                        <td class="text-center">
                            {{ $item->status_tahun_lalu ?? '-' }}        
                        </td>
                        <td class="text-center">    
                            {{ $item->status_tahun_ini ?? '-' }}
                        </td>
                        <td class="text-center">
                            {{ $item->kendala ?? '-' }}    
                        </td>
                        <td class="text-center">
                            {{ $item->tindak_lanjut ?? '-' }}
                        </td>
                        <td class="text-center">
                            {{ $item->masukkan ?? '-' }}    
                        </td>
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

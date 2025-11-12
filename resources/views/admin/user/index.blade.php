@extends('layouts.admin.app')

@section('title', 'User Management')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Table -->
        @can('create:user')
            @include('admin.user.create')
        @endcan
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{ __('No') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Role') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th class="text-center">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name ?? '-' }}</td>
                        <td>{{ $user->email ?? '-' }}</td>
                        <td>{{ $user->getRoleNames()->implode(', ') ?? '-' }}</td>
                        <td>
                            @if ($user->email_verified_at)
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @can('edit:user')
                                @include('admin.user.edit')
                            @endcan
                            @can('delete:user')
                                @include('admin.user.delete')
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <!-- /.content -->
@endsection

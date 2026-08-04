@extends('layouts.admin.app')

@section('title', 'User Management')

@section('content')
    <section class="content">
        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-users"></i> Data User</h5>
                @can('create:user')
                    @include('admin.user.create')
                @endcan
            </div>
            <div class="crud-card-body">
                <div class="table-responsive">
                    <table class="crud-table">
                        <thead>
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>NIP</th>
                                <th class="text-center">Tanda Tangan</th>
                                <th>Role</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" width="140">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="text-center"><span class="row-num">{{ $loop->iteration }}</span></td>
                                    <td class="cell-bold">{{ $user->name ?? '-' }}</td>
                                    <td>{{ $user->email ?? '-' }}</td>
                                    <td class="cell-muted">{{ $user->nip ?? '-' }}</td>
                                    <td class="text-center">
                                        @if ($user->ttd)
                                            <span class="badge-crud badge-crud-success">Ada</span>
                                        @else
                                            <span class="badge-crud badge-crud-danger">Tidak Ada</span>
                                        @endif
                                    </td>
                                    <td><span class="badge-crud badge-crud-primary">{{ $user->getRoleNames()->implode(', ') ?? '-' }}</span></td>
                                    <td class="text-center">
                                        @if ($user->email_verified_at)
                                            <span class="badge-crud badge-crud-success">Aktif</span>
                                        @else
                                            <span class="badge-crud badge-crud-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            @can('edit:user')
                                                @include('admin.user.edit')
                                            @endcan
                                            @can('delete:user')
                                                @include('admin.user.delete')
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

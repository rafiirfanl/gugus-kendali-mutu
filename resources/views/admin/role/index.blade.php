@extends('layouts.admin.app')

@section('title', 'Role Management')

@section('content')
    <section class="content">
        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-key"></i> Data Role & Permissions</h5>
            </div>
            <div class="crud-card-body">
                <div class="table-responsive">
                    <table class="crud-table">
                        <thead>
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th>Nama Role</th>
                                <th>Permissions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $index => $role)
                                <tr>
                                    <td class="text-center"><span class="row-num">{{ $index + 1 }}</span></td>
                                    <td class="cell-bold">{{ ucfirst($role->name) }}</td>
                                    <td>
                                        @foreach($role->permissions as $permission)
                                            <span class="badge-crud badge-crud-info" style="margin: 2px;">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="empty-state">
                                            <i class="fas fa-shield-alt d-block"></i>
                                            <p>Belum ada role</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

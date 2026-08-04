@extends('layouts.admin.app')
@section('title', 'Assignment Tindak Lanjut')

@section('content')
    <section class="content">
        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-tasks"></i> Progres Tindak Lanjut per Prodi</h5>
                <form action="{{ route('admin.tindak-lanjut.generate') }}" method="POST"
                    onsubmit="return confirm('Generate tindak lanjut untuk semua prodi?')" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-crud btn-crud-primary btn-crud-sm">
                        <i class="fas fa-plus mr-1"></i> Generate Tindak Lanjut
                    </button>
                </form>
            </div>
            <div class="crud-card-body">
                @if ($data->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-clipboard-list d-block"></i>
                        <p>Belum ada tindak lanjut.<br>Silakan klik <strong>Generate Tindak Lanjut</strong>.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="crud-table">
                            <thead>
                                <tr>
                                    <th class="text-center" width="60">No</th>
                                    <th>Program Studi</th>
                                    <th class="text-center" width="120">Selesai</th>
                                    <th class="text-center" width="200">Progres</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <td class="text-center"><span class="row-num">{{ $loop->iteration }}</span></td>
                                        <td class="cell-bold">{{ $row['prodi']->nama_prodi }} <span class="badge-crud badge-crud-info">{{ $row['prodi']->kode_prodi }}</span></td>
                                        <td class="text-center">{{ $row['selesai'] }} / {{ $row['total'] }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="progress-thin flex-grow-1 mr-3" style="height:8px;border-radius:4px;background:#e9ecef;overflow:hidden;">
                                                    <div class="progress-bar {{ $row['persen'] >= 75 ? 'bg-success' : ($row['persen'] >= 50 ? 'bg-warning' : 'bg-danger') }}" style="width:{{ $row['persen'] }}%;border-radius:4px;"></div>
                                                </div>
                                                <span class="font-weight-bold" style="min-width:45px;text-align:right;color:{{ $row['persen'] >= 75 ? '#34a853' : ($row['persen'] >= 50 ? '#f09819' : '#ea4335') }};">
                                                    {{ $row['persen'] }}%
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

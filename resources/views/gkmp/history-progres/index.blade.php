@extends('layouts.admin.app')

@section('title', 'History Progres Dokumen')

@section('content')
    <section class="content">

        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-history mr-2"></i> History Progres Dokumen Per Semester</h5>
            </div>
            <div class="crud-card-body">
                <div class="table-responsive">
                    <table class="crud-table">
                        <thead>
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th>Semester</th>
                                <th class="text-center" width="100">Kelas</th>
                                <th class="text-center" width="110">Ditugaskan</th>
                                <th class="text-center" width="100">Terkumpul</th>
                                <th class="text-center" width="100">Ditolak</th>
                                <th class="text-center" width="100">Total</th>
                                <th>Progres</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($history as $index => $item)
                                <tr>
                                    <td class="text-center"><span class="row-num">{{ $index + 1 }}</span></td>
                                    <td class="cell-bold">
                                        {{ $item['tahun_ajaran'] }} — {{ $item['jenis'] }}
                                        @if ($item['is_aktif'])
                                            <span class="badge-crud badge-crud-success ml-1" style="font-size:0.7rem;">Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item['total_kelas'] }}</td>
                                    <td class="text-center"><span class="badge-crud badge-crud-info">{{ $item['total_ditugaskan'] }}</span></td>
                                    <td class="text-center"><span class="badge-crud badge-crud-success">{{ $item['total_terkumpul'] }}</span></td>
                                    <td class="text-center"><span class="badge-crud badge-crud-danger">{{ $item['total_ditolak'] }}</span></td>
                                    <td class="text-center"><strong>{{ $item['total_semua'] }}</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress-thin flex-grow-1 mr-3" style="height:8px;border-radius:4px;background:#e9ecef;overflow:hidden;">
                                                <div class="progress-bar {{ $item['persentase'] >= 75 ? 'bg-success' : ($item['persentase'] >= 50 ? 'bg-warning' : 'bg-danger') }}" style="width:{{ $item['persentase'] }}%;border-radius:4px;"></div>
                                            </div>
                                            <span class="font-weight-bold" style="min-width:45px;text-align:right;color:{{ $item['persentase'] >= 75 ? '#34a853' : ($item['persentase'] >= 50 ? '#f09819' : '#ea4335') }};">{{ $item['persentase'] }}%</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox d-block"></i>
                                            <p>Belum ada data tahun ajaran</p>
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

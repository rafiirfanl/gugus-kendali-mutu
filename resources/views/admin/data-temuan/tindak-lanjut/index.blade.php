@extends('layouts.admin.app')
@section('title', 'Assignment Tindak Lanjut')

@section('content')
    <section class="content">
        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-tasks"></i> Progres Tindak Lanjut per Prodi</h5>
                <button type="button" class="btn-crud btn-crud-primary btn-crud-sm" data-bs-toggle="modal" data-bs-target="#modalGenerate">
                    <i class="fas fa-plus mr-1"></i> Generate Tindak Lanjut
                </button>
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

    <div class="modal fade modal-crud" id="modalGenerate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>Generate Tindak Lanjut</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="modal-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="modal-title-text">Generate tindak lanjut?</div>
                    <p class="modal-desc">Tindak lanjut akan dibuat otomatis untuk semua prodi berdasarkan hasil temuan yang ada.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn-crud btn-crud-secondary mr-2" data-bs-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <form action="{{ route('admin.tindak-lanjut.generate') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn-crud btn-crud-primary btn-submit">
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            <i class="fas fa-plus mr-1"></i> <span class="btn-text">Generate</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

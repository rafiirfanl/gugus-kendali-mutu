@extends('layouts.admin.app')

@section('title', 'Detail Kelas')

@section('content')
<section class="content">
    <div class="crud-card">
        <div class="crud-card-header">
            <h5><a href="{{ route('gkmp.progresKelas.index') }}" style="color:inherit;text-decoration:none;"><i class="fas fa-arrow-left mr-2"></i></a> Detail Kelas: {{ $kelas->nama_kelas }}</h5>
        </div>
        <div class="crud-card-body">
            <div class="table-responsive">
                <table class="crud-table">
                    <thead>
                        <tr>
                            <th class="text-center" width="60">No</th>
                            <th>Nama Dokumen</th>
                            <th class="text-center" width="150">Status</th>
                            <th class="text-center" width="250">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokumenKelas as $dokumen)
                            <tr>
                                <td class="text-center"><span class="row-num">{{ $loop->iteration }}</span></td>
                                <td>{{ $dokumen->dokumenPerkuliahan->nama_dokumen ?? '-' }}</td>
                                <td class="text-center">
                                    @if ($dokumen->status == 'diterima')
                                        <span class="badge-crud badge-crud-success">Terkumpul</span>
                                    @elseif ($dokumen->status == 'dikumpulkan')
                                        <span class="badge-crud badge-crud-success">Terkumpul</span>
                                    @elseif ($dokumen->status == 'ditolak')
                                        <span class="badge-crud badge-crud-danger">Ditolak</span>
                                    @else
                                        <span class="badge-crud badge-crud-warning">Belum Dikumpulkan</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        @if (in_array($dokumen->status, ['dikumpulkan', 'diterima']) && $dokumen->file_dokumen)
                                            <button class="btn-crud btn-crud-info btn-crud-sm btnLihat" data-url="{{ asset('storage/' . $dokumen->file_dokumen) }}"><i class="fas fa-eye"></i> Lihat</button>
                                            <button class="btn-crud btn-crud-primary btn-crud-sm btnDownload" data-url="{{ asset('storage/' . $dokumen->file_dokumen) }}"><i class="fas fa-download"></i> Unduh</button>
                                        @endif
                                        @if ($dokumen->status == 'dikumpulkan')
                                            <button class="btn-crud btn-crud-danger btn-crud-sm btnTolak" data-id="{{ $dokumen->id }}"><i class="fas fa-times"></i> Tolak</button>
                                        @endif
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

<div class="modal fade modal-crud" id="modalTolak" tabindex="-1" aria-labelledby="modalTolakLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius:14px;overflow:hidden;">
            <div class="modal-header modal-crud-header modal-crud-header-danger">
                <h5 class="modal-title"><i class="fas fa-exclamation-circle mr-2"></i> Catatan Penolakan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding:24px 28px;">
                <form id="formTolak" method="POST" action="{{ route('gkmp.progres-kelas.tolak') }}">
                    @csrf
                    <input type="hidden" name="dokumen_kelas_id" id="inputDokumenId">
                    <textarea class="form-crud" name="catatan" rows="4" placeholder="Tuliskan alasan penolakan..." required></textarea>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn-crud btn-crud-secondary" data-bs-dismiss="modal"><i class="fas fa-times mr-1"></i> Batal</button>
                        <button class="btn-crud btn-crud-danger"><i class="fas fa-paper-plane mr-1"></i> Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.btnLihat').forEach(btn => {
        btn.addEventListener('click', function() {
            window.open(this.dataset.url, '_blank');
        });
    });

    document.querySelectorAll('.btnDownload').forEach(btn => {
        btn.addEventListener('click', function() {
            const a = document.createElement('a');
            a.href = this.dataset.url;
            a.download = '';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        });
    });

    document.querySelectorAll('.btnTolak').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('inputDokumenId').value = this.dataset.id;
            let modal = new bootstrap.Modal(document.getElementById('modalTolak'));
            modal.show();
        });
    });
</script>
@endsection

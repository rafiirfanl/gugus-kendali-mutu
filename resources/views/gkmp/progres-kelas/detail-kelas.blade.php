@extends('layouts.admin.app')

@section('title', 'Detail Kelas')

@section('content')
<section class="content">

    <div class="card">
        <div class="card-body">

            <h4 class="mb-4"><a href="{{ route('gkmp.progresKelas.index') }}"><i class="fas fa-arrow-left mr-2 text-dark fs-6"></i></a> Detail Kelas: {{ $kelas->nama_kelas ?? 'Kelas Dummy' }}</h4>

            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Dokumen</th>
                        <th style="width: 150px;">Status</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($dokumenKelas as $dokumen)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $dokumen->dokumenPerkuliahan->nama_dokumen ?? 'Dokumen Dummy' }}</td>
                            <td class="text-center">
                                @if ($dokumen->status == 'diterima')
                                    <span class="badge bg-success">Terkumpul</span>
                                @elseif ($dokumen->status == 'dikumpulkan')
                                    <span class="badge bg-success">Terkumpul</span>
                                @elseif ($dokumen->status == 'ditolak')
                                    <span class="badge bg-danger">Tidak Terkumpul</span>
                                @else
                                    <span class="badge bg-danger">Tidak Dikumpulkan</span>
                                @endif
                            </td>
                            <td class="text-center col-md-3">
                                @if ($dokumen->status == 'dikumpulkan')
                                    <button class="btn btn-sm btn-info btnLihat" data-id="{{ $dokumen->id }}">
                                        <i class="fas fa-eye"></i> Lihat
                                    </button>
                                    <button class="btn btn-sm btn-primary btnDownload" data-id="{{ $dokumen->id }}">
                                        <i class="fas fa-download"></i> Download
                                    </button>
                                    <button class="btn btn-sm btn-danger btnTolak" data-id="{{ $dokumen->id }}">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>

</section>

<div class="modal fade" id="modalTolak" tabindex="-1" aria-labelledby="modalTolakLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalTolakLabel">Catatan Penolakan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formTolak" method="POST" action="{{ route('gkmp.progres-kelas.tolak') }}">
                    @csrf
                    <input type="hidden" name="dokumen_kelas_id" id="inputDokumenId">

                    <textarea class="form-control" name="catatan" rows="4" placeholder="Tuliskan alasan penolakan..." required></textarea>

                    <div class="mt-3 text-end">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-danger">Kirim</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.btnTolak').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('inputDokumenId').value = this.dataset.id;

            let modal = new bootstrap.Modal(document.getElementById('modalTolak'));
            modal.show();
        });
    });
</script>
@endsection

<!-- Tombol Untuk Membuka Modal Delete -->
<button role="button" class="btn btn-sm btn-danger"
    data-bs-toggle="modal" data-bs-target=".formDeleteKriteria{{ $kriteria->id }}">
    <i class="fas fa-trash"></i>
    <span class="d-none d-sm-inline">Hapus</span>
</button>

<!-- Modal Delete -->
<div class="modal fade formDeleteKriteria{{ $kriteria->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalDeleteLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="{{ route('admin.temuan.destroy', $kriteria->id) }}">
                @csrf
                @method('DELETE')

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalDeleteLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus <strong>{{ $kriteria->nama }}</strong>?</p>

                    <p class="text-danger fw-bold mb-0">
                        * Semua Subkriteria yang terkait juga akan terhapus.
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Batal</button>

                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

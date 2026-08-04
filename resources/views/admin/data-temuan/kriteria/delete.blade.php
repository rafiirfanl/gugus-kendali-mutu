<!-- Tombol Untuk Membuka Modal Delete -->
<button role="button" class="btn-crud btn-crud-danger btn-crud-sm"
    data-bs-toggle="modal" data-bs-target=".formDeleteKriteria{{ $kriteria->id }}">
    <i class="fas fa-trash"></i>
    <span class="d-none d-sm-inline">Hapus</span>
</button>

<!-- Modal Delete -->
<div class="modal fade formDeleteKriteria{{ $kriteria->id }} modal-crud modal-crud-delete" tabindex="-1" role="dialog"
    aria-labelledby="modalDeleteLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="{{ route('admin.temuan.destroy', $kriteria->id) }}">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteLabel"><i class="fas fa-exclamation-triangle mr-2"></i>Hapus Kriteria</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-center py-4">
                    <div class="modal-icon">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                    <div class="modal-title-text">Yakin ingin menghapus?</div>
                    <p class="modal-desc">Semua subkriteria yang terkait juga akan terhapus.</p>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn-crud btn-crud-secondary mr-2" data-bs-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>

                    <button type="submit" class="btn-crud btn-crud-danger btn-submit">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <i class="fas fa-trash mr-1"></i> <span class="btn-text">Hapus</span>
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

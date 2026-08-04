<!-- Button to open modal -->
<button role="button" class="btn-crud btn-crud-danger btn-crud-sm" data-bs-toggle="modal"
    data-bs-target=".formDelete{{ $user->id }}">
    <i class="fas fa-trash"></i> <span class="d-none d-sm-inline">Hapus</span>
</button>

<!-- Modal -->
<div class="modal fade formDelete{{ $user->id }} modal-crud modal-crud-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle mr-2"></i>Hapus User</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="modal-icon">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <div class="modal-title-text">Yakin ingin menghapus?</div>
                <p class="modal-desc">Data yang dihapus tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn-crud btn-crud-secondary mr-2" data-bs-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" class="btn-crud btn-crud-danger btn-submit">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <i class="fas fa-trash mr-1"></i> <span class="btn-text">Hapus</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Button to open modal -->
<button role="button" class="btn-crud btn-crud-primary btn-crud-sm" data-bs-toggle="modal" data-bs-target=".formCreate">
    <i class="fas fa-plus"></i> <span class="d-none d-sm-inline">Tambah</span>
</button>

<!-- Modal -->
<div class="modal fade formCreate modal-crud" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.prodi.store') }}" class="form-crud">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel"><i class="fas fa-plus-circle mr-2"></i>Tambah Prodi</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Prodi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_prodi') is-invalid @enderror"
                                    placeholder="Masukkan nama prodi" name="nama_prodi" value="{{ old('nama_prodi') }}" required>
                                @error('nama_prodi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kode Prodi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kode_prodi') is-invalid @enderror"
                                    placeholder="Masukkan kode prodi" name="kode_prodi" value="{{ old('kode_prodi') }}" required>
                                @error('kode_prodi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-crud btn-crud-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" class="btn-crud btn-crud-primary btn-submit">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <i class="fas fa-save mr-1"></i> <span class="btn-text">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

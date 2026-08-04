<!-- Button to open modal -->
<button role="button" class="btn-crud btn-crud-warning btn-crud-sm" data-bs-toggle="modal"
    data-bs-target=".formEdit{{ $tahunAjaran->id }}">
    <i class="fas fa-edit"></i> <span class="d-none d-sm-inline">Edit</span>
</button>

<!-- Modal -->
<div class="modal fade formEdit{{ $tahunAjaran->id }} modal-crud" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.tahunAjaran.update', $tahunAjaran->id) }}" class="form-crud">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit mr-2"></i>Edit Tahun Ajaran</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tahun Ajaran <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror"
                                    placeholder="2024/2025" name="tahun_ajaran"
                                    value="{{ old('tahun_ajaran', $tahunAjaran->tahun_ajaran) }}" required>
                                @error('tahun_ajaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status Aktif <span class="text-danger">*</span></label>
                                <select name="is_aktif" class="form-select @error('is_aktif') is-invalid @enderror" required>
                                    <option value="1" {{ old('is_aktif', $tahunAjaran->is_aktif) == 1 ? 'selected' : '' }}>Ya</option>
                                    <option value="0" {{ old('is_aktif', $tahunAjaran->is_aktif) == 0 ? 'selected' : '' }}>Tidak</option>
                                </select>
                                @error('is_aktif')
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

<!-- Button to open modal -->
<button role="button" class="btn-crud btn-crud-warning btn-crud-sm" data-bs-toggle="modal"
    data-bs-target=".formEdit{{ $dokumenPerkuliahan->id }}">
    <i class="fas fa-edit"></i> <span class="d-none d-sm-inline">Edit</span>
</button>

<!-- Modal -->
<div class="modal fade formEdit{{ $dokumenPerkuliahan->id }} modal-crud" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.dokumenPerkuliahan.update', $dokumenPerkuliahan->id) }}" enctype="multipart/form-data" class="form-crud">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit mr-2"></i>Edit Dokumen</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Nama Dokumen <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_dokumen') is-invalid @enderror"
                                    placeholder="Masukkan nama dokumen" name="nama_dokumen"
                                    value="{{ old('nama_dokumen', $dokumenPerkuliahan->nama_dokumen) }}" required>
                                @error('nama_dokumen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Sesi <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('sesi') is-invalid @enderror"
                                    placeholder="Nomor sesi" name="sesi"
                                    value="{{ old('sesi', $dokumenPerkuliahan->sesi) }}" min="1" max="4" required>
                                @error('sesi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tenggat Waktu (Minggu) <span class="text-danger">*</span></label>
                                <select name="tenggat_waktu_default" class="form-select @error('tenggat_waktu_default') is-invalid @enderror" required>
                                    @for($i = 1; $i <= 16; $i++)
                                        <option value="{{ $i }}" {{ old('tenggat_waktu_default', $dokumenPerkuliahan->tenggat_waktu_default) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('tenggat_waktu_default')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Template</label>
                                <input type="file" class="form-control @error('template') is-invalid @enderror"
                                    name="template" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                <small class="text-muted">Format: doc, docx, pdf. Maks: 2MB</small>
                                @if ($dokumenPerkuliahan->template)
                                    <div class="mt-1">
                                        <small class="text-muted">File saat ini: <a href="{{ asset('storage/' . $dokumenPerkuliahan->template) }}" target="_blank" class="text-primary"><i class="fas fa-external-link-alt"></i> Lihat Dokumen</a></small>
                                    </div>
                                @endif
                                @error('template')
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

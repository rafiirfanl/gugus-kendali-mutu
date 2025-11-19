<!-- Button to open modal -->
<button role="button" class="btn btn-sm m-1 btn-warning" data-bs-toggle="modal"
    data-bs-target=".formEdit{{ $dokumenPerkuliahan->id }}"><i class="fas fa-edit"></i><span class="d-none d-sm-inline">
        {{ __('Edit') }}</span></button>

<!-- Modal -->
<div class="modal fade formEdit{{ $dokumenPerkuliahan->id }}" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.dokumenPerkuliahan.update', $dokumenPerkuliahan->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">{{ __('Edit Data') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">{{ __('Name') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_dokumen') is-invalid @enderror"
                                    placeholder="nama_dokumen" name="nama_dokumen" id="nama_dokumen"
                                    value="{{ old('nama_dokumen', $dokumenPerkuliahan->nama_dokumen) }}" required>
                                @error('nama_dokumen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">{{ __('Sesi') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('sesi') is-invalid @enderror"
                                    placeholder="sesi" name="sesi" id="sesi"
                                    value="{{ old('sesi', $dokumenPerkuliahan->sesi) }}" required>
                                @error('sesi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">{{ __('Tenggat Waktu Default') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control @error('tenggat_waktu_default') is-invalid @enderror"
                                    placeholder="tenggat_waktu_default" name="tenggat_waktu_default"
                                    id="tenggat_waktu_default"
                                    value="{{ old('tenggat_waktu_default', $dokumenPerkuliahan->tenggat_waktu_default) }}"
                                    required>
                                @error('tenggat_waktu_default')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label class="form-label">{{ __('Template') }}<span class="text-danger">*</span> <span
                                        class="text-muted">(Allowed file types: doc, docx, pdf. Max size:
                                        2MB)</span></label>
                                <input type="file" class="form-control @error('template') is-invalid @enderror"
                                    placeholder="template" name="template" id="template"
                                    accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                    value="{{ old('template', $dokumenPerkuliahan->template) }}" required>
                                @error('template')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary btn-submit">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="btn-text">{{ __('Save') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

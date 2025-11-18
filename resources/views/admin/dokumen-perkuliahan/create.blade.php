<!-- Button to open modal -->
<button role="button" class="btn btn-sm m-1 btn-primary" data-bs-toggle="modal" data-bs-target=".formCreate"><i
        class="fas fa-plus"></i><span class="d-none d-sm-inline"> {{ __('Add') }}</span></button>

<!-- Modal -->
<div class="modal fade formCreate" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.dokumenPerkuliahan.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">{{ __('Add Data') }}</h5>
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
                                    value="{{ old('nama_dokumen') }}" required>
                                @error('nama_dokumen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">{{ __('Sesi') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('sesi') is-invalid @enderror"
                                    placeholder="sesi" name="sesi" id="sesi" value="{{ old('sesi') }}"
                                    required>
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
                                    id="tenggat_waktu_default" value="{{ old('tenggat_waktu_default') }}" required>
                                @error('tenggat_waktu_default')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">{{ __('Dikumpulkan Per') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('dikumpulkan_per') is-invalid @enderror"
                                    placeholder="dikumpulkan_per" name="dikumpulkan_per" id="dikumpulkan_per"
                                    value="{{ old('dikumpulkan_per') }}" required>
                                @error('dikumpulkan_per')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label class="form-label">{{ __('Template') }}<span class="text-danger">*</span> <span class="text-muted">(Allowed file types: doc, docx, pdf. Max size: 2MB)</span></label>
                                <input type="file" class="form-control @error('template') is-invalid @enderror"
                                    placeholder="template" name="template" id="template" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                    value="{{ old('template') }}" required>
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

<!-- Button to open modal -->
<button role="button" class="btn btn-sm m-1 btn-primary" data-bs-toggle="modal" data-bs-target=".formCreate"><i
        class="fas fa-plus"></i><span class="d-none d-sm-inline"> {{ __('Add') }}</span></button>

<!-- Modal -->
<div class="modal fade formCreate" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.kelas.store') }}" enctype="multipart/form-data">
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
                                <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror"
                                    placeholder="nama_kelas" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas') }}"
                                    required>
                                @error('nama_kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">{{ __('Id matkul dibuka') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('matkul_dibuka_id') is-invalid @enderror"
                                    placeholder="matkul_dibuka_id" name="matkul_dibuka_id" id="matkul_dibuka_id" value="{{ old('matkul_dibuka_id') }}"
                                    required>
                                @error('matkul_dibuka_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">{{ __('ID tahun ajaran') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('tahun_ajaran_id') is-invalid @enderror"
                                    placeholder="tahun_ajaran_id" name="tahun_ajaran_id" id="tahun_ajaran_id" value="{{ old('tahun_ajaran_id') }}"
                                    required>
                                @error('tahun_ajaran_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary btn-submit">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="btn-text">{{ __('Save') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

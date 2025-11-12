<!-- Button to open modal -->
<button role="button" class="btn btn-sm m-1 btn-primary" data-bs-toggle="modal" data-bs-target=".formCreate"><i
        class="fas fa-plus"></i><span class="d-none d-sm-inline"> {{ __('Add') }}</span></button>

<!-- Modal -->
<div class="modal fade formCreate" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.matkul.store') }}" enctype="multipart/form-data">
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
                                <input type="text" class="form-control @error('nama_matkul') is-invalid @enderror"
                                    placeholder="nama_matkul" name="nama_matkul" id="nama_matkul" value="{{ old('nama_matkul') }}"
                                    required>
                                @error('nama_matkul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">{{ __('kode_matkul') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kode_matkul') is-invalid @enderror"
                                    placeholder="kode_matkul" name="kode_matkul" id="kode_matkul" value="{{ old('kode_matkul') }}"
                                    required>
                                @error('kode_matkul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">{{ __('Bobot SKS') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('bobot_sks') is-invalid @enderror"
                                    placeholder="bobot_sks" name="bobot_sks" id="bobot_sks" value="{{ old('bobot_sks') }}"
                                    required>
                                @error('bobot_sks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">{{ __('praktikum') }}<span class="text-danger">*</span></label>
                                <select name="praktikum" id="praktikum" class="form-control @error('praktikum') is-invalid @enderror" required>
                                    <option value="1" {{ old('praktikum') == '1' ? 'selected' : '' }}>{{ __('Yes') }}</option>
                                    <option value="0" {{ old('praktikum') == '0' ? 'selected' : '' }}>{{ __('No') }}</option>
                                </select>
                                @error('praktikum')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">{{ __('prodi_id') }}<span class="text-danger">*</span></label>
                                <select name="prodi_id" id="prodi_id" class="form-control @error('prodi_id') is-invalid @enderror" required>
                                    <option value="">{{ __('Select Prodi') }}</option>
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->id }}" {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                                    @endforeach
                                </select>
                                @error('prodi_id')
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

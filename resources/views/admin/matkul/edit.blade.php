<!-- Button to open modal -->
<button role="button" class="btn btn-sm m-1 btn-warning" data-bs-toggle="modal"
    data-bs-target=".formEdit{{ $matkul->id }}"><i class="fas fa-edit"></i><span class="d-none d-sm-inline">
        {{ __('Edit') }}</span></button>

<!-- Modal -->
<div class="modal fade formEdit{{ $matkul->id }}" tabindex="-1" role="dialog" aria-hidden="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.matkul.update', $matkul->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">{{ __('Edit Data') }}
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label class="form-label">{{ __('Name') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_matkul') is-invalid @enderror"
                                    placeholder="nama_matkul" name="nama_matkul" id="nama_matkul"
                                    value="{{ old('nama_matkul', $matkul->nama_matkul) }}" required>
                                @error('nama_matkul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">{{ __('Kode Matkul') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kode_matkul') is-invalid @enderror"
                                    placeholder="kode_matkul" name="kode_matkul" id="kode_matkul" value="{{ old('kode_matkul', $matkul->kode_matkul) }}"
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
                                    placeholder="bobot_sks" name="bobot_sks" id="bobot_sks" value="{{ old('bobot_sks', $matkul->bobot_sks) }}"
                                    required>
                                @error('bobot_sks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">{{ __('Praktikum') }}<span class="text-danger">*</span></label>
                                <select name="praktikum" id="praktikum" class="form-control @error('praktikum') is-invalid @enderror" required>
                                    <option value="1" {{ old('praktikum', $matkul->praktikum) == '1' ? 'selected' : '' }}>{{ __('Yes') }}</option>
                                    <option value="0" {{ old('praktikum', $matkul->praktikum) == '0' ? 'selected' : '' }}>{{ __('No') }}</option>
                                </select>
                                @error('praktikum')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">{{ __('Prodi') }}<span class="text-danger">*</span></label>
                                <select name="prodi_id" id="prodi_id" class="form-control @error('prodi_id') is-invalid @enderror" required>
                                    <option value="">{{ __('Select Prodi') }}</option>
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->id }}" {{ old('prodi_id', $matkul->prodi_id) == $prodi->id ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
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

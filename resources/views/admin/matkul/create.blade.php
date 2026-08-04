<!-- Button to open modal -->
<button role="button" class="btn-crud btn-crud-primary btn-crud-sm" data-bs-toggle="modal" data-bs-target=".formCreate">
    <i class="fas fa-plus"></i> <span class="d-none d-sm-inline">Tambah</span>
</button>

<!-- Modal -->
<div class="modal fade formCreate modal-crud" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.matkul.store') }}" class="form-crud">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel"><i class="fas fa-plus-circle mr-2"></i>Tambah Mata Kuliah</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Nama Mata Kuliah <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_matkul') is-invalid @enderror"
                                    placeholder="Masukkan nama mata kuliah" name="nama_matkul" value="{{ old('nama_matkul') }}" required>
                                @error('nama_matkul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kode Matkul <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kode_matkul') is-invalid @enderror"
                                    placeholder="Masukkan kode matkul" name="kode_matkul" value="{{ old('kode_matkul') }}" required>
                                @error('kode_matkul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Bobot SKS <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('bobot_sks') is-invalid @enderror"
                                    placeholder="Masukkan bobot SKS" name="bobot_sks" value="{{ old('bobot_sks') }}" required>
                                @error('bobot_sks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Praktikum <span class="text-danger">*</span></label>
                                <select name="praktikum" class="form-select @error('praktikum') is-invalid @enderror" required>
                                    <option value="1" {{ old('praktikum') == '1' ? 'selected' : '' }}>Ya</option>
                                    <option value="0" {{ old('praktikum') == '0' ? 'selected' : '' }}>Tidak</option>
                                </select>
                                @error('praktikum')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Prodi <span class="text-danger">*</span></label>
                                <select name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Prodi --</option>
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
                    <button type="button" class="btn-crud btn-crud-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" class="btn-crud btn-crud-primary btn-submit">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <i class="fas fa-save mr-1"></i> <span class="btn-text">Simpan</span>
                    </button>
                </div>
            </form>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var modalEl = document.querySelector('.formCreate');
                    $(modalEl).on('shown.bs.modal', function() {
                        $(modalEl).find('.form-select').each(function() {
                            if (!$(this).data('select2')) {
                                $(this).select2({ theme: 'bootstrap-5', width: '100%', dropdownParent: $(modalEl) });
                            }
                        });
                    });
                });
            </script>
        </div>
    </div>
</div>

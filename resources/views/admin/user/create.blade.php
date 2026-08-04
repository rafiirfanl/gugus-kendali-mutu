<!-- Button to open modal -->
<button role="button" class="btn-crud btn-crud-primary btn-crud-sm" data-bs-toggle="modal" data-bs-target=".formCreate">
    <i class="fas fa-plus"></i> <span class="d-none d-sm-inline">Tambah</span>
</button>

<!-- Modal -->
<div class="modal fade formCreate modal-crud" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data" class="form-crud">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel"><i class="fas fa-user-plus mr-2"></i>Tambah User</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Masukkan nama" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Masukkan email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">NIP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                    placeholder="Masukkan NIP" name="nip" value="{{ old('nip') }}" required>
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanda Tangan <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('ttd') is-invalid @enderror"
                                    name="ttd" accept="image/png,image/jpeg" required>
                                @error('ttd')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Masukkan password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Roles <span class="text-danger">*</span></label>
                                <select class="form-select @error('role') is-invalid @enderror" name="role" id="role" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6" id="prodiWrapper">
                            <div class="mb-3">
                                <label class="form-label">Prodi <span class="text-danger">*</span></label>
                                <select class="form-select @error('prodi_id') is-invalid @enderror" name="prodi_id">
                                    <option value="">-- Pilih Prodi --</option>
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                    @endforeach
                                </select>
                                @error('prodi_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('email_verified') is-invalid @enderror" name="email_verified" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                @error('email_verified')
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
                    const roleSelect = document.getElementById('role');
                    const prodiWrapper = document.getElementById('prodiWrapper');
                    function toggleProdi() {
                        const role = roleSelect.value;
                        const userRole = "{{ Auth::user()->roles->first()->name }}";
                        if (userRole === 'gkmp' || userRole === 'kaprodi') { prodiWrapper.style.display = 'none'; return; }
                        if (userRole === 'gkmf') { prodiWrapper.style.display = role === 'gkmf' ? 'none' : 'block'; }
                    }
                    roleSelect.addEventListener('change', toggleProdi);
                    toggleProdi();

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

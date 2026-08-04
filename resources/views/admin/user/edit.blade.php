<!-- Button to open modal -->
<button role="button" class="btn-crud btn-crud-warning btn-crud-sm" data-bs-toggle="modal"
    data-bs-target=".formEdit{{ $user->id }}">
    <i class="fas fa-edit"></i> <span class="d-none d-sm-inline">Edit</span>
</button>

<!-- Modal -->
<div class="modal fade formEdit{{ $user->id }} modal-crud" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data" class="form-crud">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user-edit mr-2"></i>Edit User</h5>
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
                                    placeholder="Masukkan nama" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Masukkan email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">NIP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                    placeholder="Masukkan NIP" name="nip" value="{{ old('nip', $user->nip) }}" required>
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanda Tangan</label>
                                <input type="file" class="form-control @error('ttd') is-invalid @enderror"
                                    name="ttd" accept="image/png,image/jpeg">
                                @if ($user->ttd)
                                    <div class="mt-1">
                                        <small class="text-muted">File tersimpan: <a href="{{ asset('storage/' . $user->ttd) }}" target="_blank" class="text-success"><i class="fas fa-external-link-alt"></i> Lihat</a></small>
                                    </div>
                                @else
                                    <div class="mt-1"><small class="text-danger">Belum ada tanda tangan</small></div>
                                @endif
                                @error('ttd')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Password (Opsional)</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Kosongkan jika tidak diubah" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Roles <span class="text-danger">*</span></label>
                                <select class="form-select @error('role') is-invalid @enderror" name="role" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ old('role', $user->getRoleNames()->first()) == $role->name ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('email_verified') is-invalid @enderror" name="email_verified" required>
                                    <option value="1" {{ $user->email_verified_at ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ !$user->email_verified_at ? 'selected' : '' }}>Tidak Aktif</option>
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
                    var modalEl = document.querySelector('.formEdit{{ $user->id }}');
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

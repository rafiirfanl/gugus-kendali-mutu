<!-- Button to open modal -->
<button role="button" class="btn btn-sm m-1 btn-primary" data-bs-toggle="modal" data-bs-target=".formCreate"><i
        class="fas fa-plus"></i><span class="d-none d-sm-inline"> {{ __('Add') }}</span></button>

<!-- Modal -->
<div class="modal fade formCreate" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">{{ __('Add Data') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label class="form-label">{{ __('Name') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="name" name="name" id="name" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Email') }}<span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="email" name="email" id="email" value="{{ old('email') }}"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('NIP') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                    placeholder="nip" name="nip" id="nip" value="{{ old('nip') }}"
                                    required>
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Tanda Tangan') }}<span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('ttd') is-invalid @enderror"
                                    name="ttd" id="ttd" accept="image/png,image/jpeg" required>
                                @error('ttd')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Password') }}<span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="password" name="password" id="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Roles') }}<span class="text-danger">*</span></label>
                                <select class="form-select @error('role') is-invalid @enderror" name="role"
                                    id="role" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6" id="prodiWrapper">
                            <div class="mb-3">
                                <label class="form-label">Prodi<span class="text-danger">*</span></label>
                                <select class="form-select @error('prodi_id') is-invalid @enderror" name="prodi_id"
                                    id="prodi_id">
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
                                <label class="form-label">{{ __('Status') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('email_verified') is-invalid @enderror"
                                    name="email_verified" id="email_verified" required>
                                    <option value="1" {{ old('email_verified') == '1' ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="0" {{ old('email_verified') == '0' ? 'selected' : '' }}>Tidak
                                        Aktif</option>
                                </select>
                                @error('email_verified')
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
                        <span class="spinner-border spinner-border-sm d-none" role="status"
                            aria-hidden="true"></span>
                        <span class="btn-text">{{ __('Save') }}</span>
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

                        // Jika GKMP atau Kaprodi sedang login, sembunyikan dropdown Prodi
                        if (userRole === 'gkmp' || userRole === 'kaprodi') {
                            prodiWrapper.style.display = 'none';
                            return;
                        }

                        // Jika GKMF login:
                        if (userRole === 'gkmf') {
                            if (role === 'gkmf') {
                                prodiWrapper.style.display = 'none'; // GKMF tidak pakai prodi
                            } else {
                                prodiWrapper.style.display = 'block'; // GKMP atau Kaprodi wajib pilih prodi
                            }
                        }
                    }

                    roleSelect.addEventListener('change', toggleProdi);
                    toggleProdi(); // init saat modal dibuka
                });
            </script>

        </div>
    </div>
</div>

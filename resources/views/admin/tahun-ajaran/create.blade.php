<!-- Button to open modal -->
<button role="button" class="btn-crud btn-crud-primary btn-crud-sm" data-bs-toggle="modal" data-bs-target=".formCreate">
    <i class="fas fa-plus"></i> <span class="d-none d-sm-inline">Tambah</span>
</button>

<!-- Modal -->
<div class="modal fade formCreate modal-crud" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.tahunAjaran.store') }}" class="form-crud">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel"><i class="fas fa-plus-circle mr-2"></i>Tambah Tahun Ajaran</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tahun Awal <span class="text-danger">*</span></label>
                                <input type="text" class="js-datepicker form-control" id="tahun1" name="tahun1"
                                    placeholder="Dari" value="{{ old('tahun1', date('Y')) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tahun Akhir <span class="text-danger">*</span></label>
                                <input type="text" class="js-datepicker form-control" id="tahun2" name="tahun2"
                                    placeholder="Ke" value="{{ old('tahun2', date('Y') + 1) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Jenis Semester <span class="text-danger">*</span></label>
                                <select class="form-select js-select2" name="jenis" required>
                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>
                                    <option value="Pendek">Pendek</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Mulai Perkuliahan <span class="text-danger">*</span></label>
                                <input type="text"
                                    class="js-flatpickr form-control @error('tanggal_mulai_kuliah') is-invalid @enderror"
                                    name="tanggal_mulai_kuliah" placeholder="Pilih tanggal mulai"
                                    data-date-format="j F Y" data-min-date="today" value="{{ old('tanggal_mulai_kuliah') }}" required>
                                @error('tanggal_mulai_kuliah')
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
                    <button type="submit" class="btn-crud btn-crud-success btn-submit">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <i class="fas fa-save mr-1"></i> <span class="btn-text">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
    <script>
        $(function() {
            $("#tahun1").datepicker({ format: "yyyy", viewMode: "years", minViewMode: "years" });
            $("#tahun2").datepicker({ format: "yyyy", viewMode: "years", minViewMode: "years" });
            $('#tahun1').on('change', function() { $('#tahun2').val(parseInt($(this).val()) + 1); });
            $('#tahun2').on('change', function() { $('#tahun1').val(parseInt($(this).val()) - 1); });
            flatpickr(".js-flatpickr", { dateFormat: "j F Y", minDate: "today" });
            $('.js-select2').select2({ placeholder: "Jenis Semester", width: "100%" });
            $('.formCreate').on('shown.bs.modal', function() {
                flatpickr(".js-flatpickr", { dateFormat: "j F Y", minDate: "today" });
                $('.js-select2').select2({ placeholder: "Jenis Semester", width: "100%", dropdownParent: $('.formCreate') });
            });
        });
    </script>
@endsection

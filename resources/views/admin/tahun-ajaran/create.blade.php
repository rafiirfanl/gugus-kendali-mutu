<!-- Button to open modal -->
<button role="button" class="btn btn-sm m-1 btn-primary" data-bs-toggle="modal" data-bs-target=".formCreate">
    <i class="fas fa-plus"></i>
    <span class="d-none d-sm-inline"> {{ __('Add') }}</span>
</button>

<!-- Modal -->
<div class="modal fade formCreate" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content p-3">

            <form method="POST" action="{{ route('admin.tahunAjaran.store') }}">
                @csrf

                <h4 class="border-bottom pb-2">Tahun Ajaran Baru</h4>

                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="form-label">Tahun Ajaran</label>
                    </div>

                    <div class="col-lg-2 col-xl-4">
                        <div class="mb-4">
                            <div class="input-daterange input-group">

                                <!-- Tahun Awal -->
                                <input type="text" class="js-datepicker form-control" id="tahun1" name="tahun1"
                                    placeholder="Dari" value="{{ old('tahun1', date('Y')) }}" required>

                                <span class="input-group-text fw-semibold">/</span>

                                <!-- Tahun Akhir -->
                                <input type="text" class="js-datepicker form-control" id="tahun2" name="tahun2"
                                    placeholder="Ke" value="{{ old('tahun2', date('Y') + 1) }}" required>

                                <!-- Jenis Semester -->
                                <select class="js-select2 form-select" name="jenis" data-placeholder="Jenis" required>
                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>
                                    <option value="Pendek">Pendek</option>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tanggal Mulai Kuliah -->
                <div class="row">
                    <div class="col-lg-3">
                        <label class="form-label">Tanggal Mulai Perkuliahan</label>
                    </div>

                    <div class="col-lg-8 col-xl-4">
                        <div class="mb-3">
                            <input type="text"
                                class="js-flatpickr form-control @error('tanggal_mulai_kuliah') is-invalid @enderror"
                                name="tanggal_mulai_kuliah" placeholder="Masukkan tanggal mulai perkuliahan"
                                data-date-format="j F Y" data-min-date="today" value="{{ old('tanggal_mulai_kuliah') }}"
                                required>

                            @error('tanggal_mulai_kuliah')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="row mt-5 text-end me-4 mb-3">
                    <div class="col">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

@section('script')
    <script>
        // Datepicker Tahun
        $("#tahun1").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
        });

        $("#tahun2").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
        });

        // Auto update tahun2
        $('#tahun1').on('change', function() {
            $('#tahun2').val(parseInt($(this).val()) + 1);
        });

        $('#tahun2').on('change', function() {
            $('#tahun1').val(parseInt($(this).val()) - 1);
        });

        // Flatpickr
        flatpickr(".js-flatpickr", {
            dateFormat: "j F Y",
            minDate: "today"
        });

        // Select2
        $('.js-select2').select2({
            placeholder: "Jenis Semester",
            width: "100%"
        });

        $('.formCreate').on('shown.bs.modal', function() {
            flatpickr(".js-flatpickr", {
                dateFormat: "j F Y",
                minDate: "today"
            });
        });
    </script>
@endsection

@extends('layouts.admin.app')

@section('title', 'Assignment Dosen')

@section('content')
    <section class="content">
        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-user-plus"></i> Assignment Dosen — Jumlah Kelas & Mata Kuliah</h5>
                <div class="d-flex gap-2">
                    <button class="btn-crud btn-crud-primary btn-crud-sm btn-all" type="button">
                        <i class="fas fa-check mr-1"></i> Semua
                    </button>
                    <button class="btn-crud btn-crud-danger btn-crud-sm btn-reset" type="button">
                        <i class="fas fa-undo mr-1"></i> Reset
                    </button>
                </div>
            </div>
            <div class="crud-card-body">
                <form id="assignmentForm" action="{{ route('admin.assignmentDosen.stepTwo') }}" method="GET">
                    @csrf

                    <div class="table-responsive">
                        <table class="crud-table">
                            <thead>
                                <tr>
                                    <th style="width: 80%">Mata Kuliah</th>
                                    <th class="text-center" style="width: 20%">Jumlah Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matkuls as $key => $item)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input form-matkul-dibuka" type="checkbox" value="{{ $item->id }}" id="checkbox_{{ $key }}" name="matkul_id[]">
                                                <label class="form-check-label" for="checkbox_{{ $key }}">{{ $item->nama_matkul }}</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-crud jumlah_kelas_input" name="jumlah_kelas[]" min="1" placeholder="Jumlah Kelas" disabled>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end gap-2 p-4">
                        <button type="button" class="btn-crud btn-crud-primary btn-next">
                            <i class="fas fa-arrow-right mr-1"></i> Selanjutnya
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.form-matkul-dibuka');
            const jumlahInputs = document.querySelectorAll('.jumlah_kelas_input');
            const form = document.getElementById('assignmentForm');
            const hasAssignment = {{ $hasAssignment ? 'true' : 'false' }};
            const tahunAjaranLabel = '{{ $tahunAjaranAktif->tahun_ajaran }} {{ $tahunAjaranAktif->jenis ?? '' }}'.trim();

            checkboxes.forEach((chk, index) => {
                chk.addEventListener('change', function() {
                    jumlahInputs[index].disabled = !this.checked;
                    if (!this.checked) jumlahInputs[index].value = "";
                });
            });

            document.querySelector('.btn-all').addEventListener('click', function() {
                checkboxes.forEach((chk, i) => {
                    chk.checked = true;
                    jumlahInputs[i].disabled = false;
                });
            });

            document.querySelector('.btn-reset').addEventListener('click', function() {
                checkboxes.forEach((chk, i) => {
                    chk.checked = false;
                    jumlahInputs[i].disabled = true;
                    jumlahInputs[i].value = "";
                });
            });

            document.querySelector('.btn-next').addEventListener('click', function() {
                const checked = document.querySelectorAll('.form-matkul-dibuka:checked');
                if (checked.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Pilih minimal satu mata kuliah terlebih dahulu.',
                        confirmButtonColor: '#d33',
                    });
                    return;
                }

                let title, text, confirmButtonText, confirmButtonColor;
                if (hasAssignment) {
                    title = 'Assignment Dosen Sudah Ada';
                    text = 'Anda sudah pernah melakukan Assignment Dosen pada Tahun Ajaran ' + tahunAjaranLabel + ', apakah anda yakin untuk membuat ulang Assignment Dosen pada Tahun Ajaran ' + tahunAjaranLabel + '?';
                    confirmButtonText = 'Ya, Buat Ulang';
                    confirmButtonColor = '#e67e22';
                } else {
                    title = 'Konfirmasi Assignment Dosen';
                    text = 'Apakah anda yakin ingin melakukan assignment dosen untuk Tahun Ajaran ' + tahunAjaranLabel + '?';
                    confirmButtonText = 'Ya, Lanjutkan';
                    confirmButtonColor = '#28a745';
                }

                Swal.fire({
                    icon: 'question',
                    title: title,
                    text: text,
                    showCancelButton: true,
                    confirmButtonColor: confirmButtonColor,
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: confirmButtonText,
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection

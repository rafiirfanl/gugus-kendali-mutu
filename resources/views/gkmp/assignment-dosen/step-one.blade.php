@extends('layouts.admin.app')

@section('title', 'Assignment Dosen')

@section('content')
    <section class="content">

        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-user-plus"></i> Assignment Dosen — Jumlah Kelas & Mata Kuliah</h5>
            </div>
            <div class="crud-card-body">
                <form action="{{ route('admin.assignmentDosen.stepTwo') }}" method="GET">
                    @csrf

                    <div class="d-flex justify-content-between align-items-center mb-2 px-1">
                        <h6 class="mb-0" style="font-weight:700;"><i class="fas fa-book mr-1"></i> Mata Kuliah Yang Dibuka</h6>
                        <div class="d-flex gap-2">
                            <button class="btn-crud btn-crud-success btn-crud-sm btn-all" type="button"><i class="fas fa-check mr-1"></i> Semua</button>
                            <button class="btn-crud btn-crud-danger btn-crud-sm btn-reset" type="button"><i class="fas fa-undo mr-1"></i> Reset</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="crud-table">
                            <thead>
                                <tr>
                                    <th style="width: 80%">Mata Kuliah</th>
                                    <th class="text-center">Jumlah Kelas</th>
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

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn-crud btn-crud-primary"><i class="fas fa-arrow-right mr-1"></i> Selanjutnya</button>
                    </div>

                </form>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.form-matkul-dibuka');
            const jumlahInputs = document.querySelectorAll('.jumlah_kelas_input');

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
        });
    </script>

@endsection

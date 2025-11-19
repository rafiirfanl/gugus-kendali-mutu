@extends('layouts.admin.app')

@section('title', 'Assignment Dosen')

@section('content')
    <section class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Assignment Dosen — Jumlah Kelas & Mata Kuliah</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.assignmentDosen.stepTwo') }}" method="GET">
                    @csrf

                    <h4 class="border-bottom pb-2">Mata Kuliah Yang Dibuka</h4>

                    <div class="d-flex justify-content-between my-3">
                        <button class="btn btn-success btn-all" type="button">
                            <i class="fa fa-check me-1"></i> Semua
                        </button>

                        <button class="btn btn-danger btn-reset" type="button">
                            <i class="fa fa-refresh me-1"></i> Reset
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th style="width: 85%">Mata Kuliah</th>
                                    <th class="text-center">Jumlah Kelas</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($matkuls as $key => $item)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input form-matkul-dibuka" type="checkbox"
                                                    value="{{ $item->id }}" id="checkbox_{{ $key }}"
                                                    name="matkul_id[]">

                                                <label class="form-check-label" for="checkbox_{{ $key }}">
                                                    {{ $item->nama_matkul }}
                                                </label>
                                            </div>
                                        </td>

                                        <td>
                                            <input type="number" class="form-control jumlah_kelas_input"
                                                name="jumlah_kelas[]" min="1" placeholder="Jumlah Kelas" disabled>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Selanjutnya
                    </button>

                </form>
            </div>
        </div>
    </section>

    {{-- ENABLE/DISABLE INPUT --}}
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

            // Tombol pilih semua
            document.querySelector('.btn-all').addEventListener('click', function() {
                checkboxes.forEach((chk, i) => {
                    chk.checked = true;
                    jumlahInputs[i].disabled = false;
                });
            });

            // Tombol reset
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

@extends('layouts.admin.app')

@section('title', 'Assignment Dosen')

<style>
    .crud-card-header {
        background: linear-gradient(135deg, var(--crud-primary) 0%, var(--crud-primary-light) 100%) !important;
        border-bottom: none !important;
    }
    .crud-card-header h5 { color: #fff !important; }
    .crud-card-header h5 i { color: rgba(255,255,255,0.8) !important; }
</style>

@section('content')
    <section class="content">
        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-user-plus"></i> Assignment Dosen — Jumlah Kelas & Mata Kuliah</h5>
                <div class="d-flex gap-2">
                    <button class="btn-crud btn-crud-success btn-crud-sm btn-all" type="button">
                        <i class="fas fa-check mr-1"></i> Semua
                    </button>
                    <button class="btn-crud btn-crud-danger btn-crud-sm btn-reset" type="button">
                        <i class="fas fa-undo mr-1"></i> Reset
                    </button>
                </div>
            </div>
            <div class="crud-card-body">
                <form action="{{ route('admin.assignmentDosen.stepTwo') }}" method="GET">
                    @csrf

                    <div class="p-4">
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

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="submit" class="btn-crud btn-crud-primary">
                                <i class="fas fa-arrow-right mr-1"></i> Selanjutnya
                            </button>
                        </div>
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

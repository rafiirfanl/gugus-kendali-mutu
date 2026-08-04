@extends('layouts.admin.app')

@section('title', 'Assignment Dosen - Step 2')

@section('content')

    <section class="content">
        <div class="progress-modern mb-3">
            <div class="progress-bar bg-primary" style="width:100%;"></div>
        </div>
        <div class="text-center mb-4" style="font-weight:700;color:#0c3366;">Step 2 — Dosen dan Tipe Dokumen</div>

        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-users"></i> Dosen Pengampu Tiap Kelas</h5>
            </div>
            <div class="crud-card-body">
                <form action="{{ route('admin.assignmentDosen.submitStepOneAndTwo') }}" method="POST">
                    @csrf

                    @foreach ($matkul as $key => $m)
                        <div class="mb-4">
                            <h6 class="cell-bold border-bottom pb-2"><i class="fas fa-book mr-1"></i> {{ $m->nama_matkul }}</h6>

                            <div class="table-responsive">
                                <table class="crud-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:25%">Kelas</th>
                                            <th class="text-center">Dosen Pengampu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $huruf = 'A'; @endphp
                                        @for ($i = 0; $i < $jumlah_kelas[$key]; $i++)
                                            <tr>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-crud" name="kelas[{{ $m->id }}][{{ $i }}][nama_kelas]" value="{{ 'Kelas R' . ($jumlah_kelas[$key] == 1 ? '' : $huruf) }}" readonly>
                                                </td>
                                                <td>
                                                    <select class="form-select form-crud select2" name="kelas[{{ $m->id }}][{{ $i }}][dosen_id]" required>
                                                        <option value="">-- Pilih Dosen --</option>
                                                        @foreach ($dosen[$m->id] as $d)
                                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            @php $huruf++; @endphp
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn-crud btn-crud-primary"><i class="fas fa-save mr-1"></i> Simpan Step 2</button>
                    </div>

                </form>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('.select2').select2({ theme: 'bootstrap-5', width: '100%' });
        });
    </script>

@endsection

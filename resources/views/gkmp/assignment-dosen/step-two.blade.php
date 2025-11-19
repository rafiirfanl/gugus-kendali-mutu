@extends('layouts.admin.app')

@section('title', 'Assignment Dosen - Step 2')

@section('content')

    <!-- Progress -->
    <div class="content mb-3">
        <div class="progress" style="height: 10px;">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
        </div>
        <div class="text-center mt-2 fw-bold">
            Step 2 — Dosen dan Tipe Dokumen
        </div>
    </div>
    <!-- End Progress -->

    <div class="content">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title">Dosen Pengampu Tiap Kelas</h5>
            </div>
            <div class="card-body">

                <form action="{{ route('admin.assignmentDosen.submitStepOneAndTwo') }}" method="POST">
                    @csrf

                    <!-- ======================= -->
                    <!-- MATKUL → KELAS → DOSEN -->
                    <!-- ======================= -->

                    @foreach ($matkul as $key => $m)
                        <div class="mb-4">
                            <h5 class="fw-bold border-bottom pb-2">{{ $m->nama_matkul }}</h5>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:20%">Kelas</th>
                                            <th class="text-center">Dosen Pengampu</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $huruf = 'A'; @endphp

                                        @for ($i = 0; $i < $jumlah_kelas[$key]; $i++)
                                            <tr>
                                                <td class="text-center">

                                                    <!-- Nama kelas -->

                                                    <input type="text" class="form-control"
                                                        name="kelas[{{ $m->id }}][{{ $i }}][nama_kelas]"
                                                        value="{{ 'Kelas R' . ($jumlah_kelas[$key] == 1 ? '' : $huruf) }}"
                                                        readonly>

                                                </td>

                                                <td>

                                                    <!-- Pilihan dosen -->

                                                    <select class="form-control select2"
                                                        name="kelas[{{ $m->id }}][{{ $i }}][dosen_id]"
                                                        required>

                                                        <option value="">-- Pilih Dosen --</option>

                                                        @foreach ($dosen[$m->id] as $d)
                                                            <option value="{{ $d->id }}">
                                                                {{ $d->name }}
                                                            </option>
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

                    <!-- Tombol submit -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5">
                            Simpan Step 2
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%'
            });
        });
    </script>


@endsection

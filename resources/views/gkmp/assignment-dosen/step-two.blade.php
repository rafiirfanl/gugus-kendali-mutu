@extends('layouts.admin.app')

@section('title', 'Assignment Dosen - Step 2')

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
                <h5><i class="fas fa-users"></i> Dosen Pengampu Tiap Kelas</h5>
            </div>
            <div class="crud-card-body">
                <form action="{{ route('admin.assignmentDosen.submitStepOneAndTwo') }}" method="POST">
                    @csrf

                    <div class="p-4">
                        @foreach ($matkul as $key => $m)
                            <div class="mb-4">
                                <h6 style="background:linear-gradient(135deg,var(--crud-primary),var(--crud-primary-light));color:#fff;padding:10px 16px;border-radius:8px;font-size:0.92rem;font-weight:700;margin-bottom:1rem;">
                                    <i class="fas fa-book mr-1" style="color:rgba(255,255,255,0.8);"></i> {{ $m->nama_matkul }}
                                </h6>

                                <div class="table-responsive">
                                    <table class="crud-table">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width:25%">Kelas</th>
                                                <th>Dosen Pengampu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $huruf = 'A'; @endphp
                                            @for ($i = 0; $i < $jumlah_kelas[$key]; $i++)
                                                <tr>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control form-crud" name="kelas[{{ $m->id }}][{{ $i }}][nama_kelas]" value="{{ 'Kelas R' . ($jumlah_kelas[$key] == 1 ? '' : $huruf) }}" readonly style="max-width:180px;margin:0 auto;">
                                                    </td>
                                                    <td>
                                                        <select class="form-select form-crud select2-dosen" name="kelas[{{ $m->id }}][{{ $i }}][dosen_id]" required>
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

                        <div class="d-flex justify-content-center gap-2 mt-4 pt-3" style="border-top:2px solid #e9ecef;">
                            <a href="{{ route('admin.assignmentDosen.stepOne') }}" class="btn-crud btn-crud-secondary">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn-crud btn-crud-primary">
                                <i class="fas fa-save mr-1"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('.select2-dosen').select2({ theme: 'bootstrap-5', width: '100%' });
        });
    </script>
@endsection

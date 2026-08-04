@extends('layouts.admin.app')

@section('title', 'GKMP Progres Tindak Lanjut')

@section('content')
    <section class="content">
        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-tasks"></i> Tindak Lanjut</h5>
            </div>
            <div class="crud-card-body" style="padding: 22px;">
                <div class="d-flex align-items-center mb-4 p-3 rounded" style="background: #e3f2fd; border-left: 4px solid #1a73e8;">
                    <i class="fas fa-chart-line mr-3" style="font-size:1.5rem;color:#1a73e8;"></i>
                    <div>
                        <strong>Progres Prodi:</strong>
                        <span class="badge-crud badge-crud-info ml-2">{{ $persenProdi }}%</span>
                        <span class="ml-2" style="font-size:0.88rem;color:#555;">
                            ({{ $selesai }} dari {{ $total }} tindak lanjut selesai)
                        </span>
                    </div>
                </div>

                <div class="accordion" id="accordionKriteria">
                    @foreach ($tindak_lanjuts as $namaKriteria => $kriteria)
                        @php
                            $collapseId = 'collapseKriteria' . $loop->index;
                            $headingId = 'headingKriteria' . $loop->index;
                        @endphp
                        <div class="accordion-item mb-3" style="border: 1px solid #e9ecef; border-radius: 10px; overflow: hidden;">
                            <h2 class="accordion-header" id="{{ $headingId }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#{{ $collapseId }}" style="font-weight:600; font-size:0.95rem;">
                                    <i class="fas fa-chevron-right mr-2" style="font-size:0.8rem;"></i>
                                    Kriteria: {{ $namaKriteria }}
                                    <span class="badge-crud badge-crud-info ml-3">{{ $kriteria['persen'] }}%</span>
                                </button>
                            </h2>
                            <div id="{{ $collapseId }}" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    @foreach ($kriteria['subkriteria'] as $namaSubkriteria => $sub)
                                        <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                                            <h6 class="mb-0" style="font-weight:700; color:#1a1a2e;">
                                                <i class="fas fa-tag mr-1" style="font-size:0.8rem; color:#6c757d;"></i>
                                                Subkriteria: {{ $namaSubkriteria }}
                                            </h6>
                                            <span class="badge-crud badge-crud-success">{{ $sub['persen'] }}%</span>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="crud-table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" width="50">No</th>
                                                        <th width="25%">Hasil Temuan</th>
                                                        <th width="15%">Masukan</th>
                                                        <th width="30%">Tindak Lanjut</th>
                                                        <th width="15%">Kendala</th>
                                                        <th class="text-center" width="100">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($sub['items'] as $tindak_lanjut)
                                                        <tr>
                                                            <form action="{{ route('gkmp.tindak-lanjut.update', $tindak_lanjut->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td class="text-center"><span class="row-num">{{ $loop->iteration }}</span></td>
                                                                <td style="font-size:0.85rem;">{{ $tindak_lanjut->hasilTemuan->hasil_temuan ?? '-' }}</td>
                                                                <td>
                                                                    <textarea name="masukan" placeholder="Isi tanda (-)" class="form-control form-control-sm" rows="2" style="border-radius:8px; font-size:0.82rem;">{{ old('masukan', $tindak_lanjut->masukan) }}</textarea>
                                                                </td>
                                                                <td>
                                                                    <textarea name="tindak_lanjut" placeholder="Isi tanda (-)" class="form-control form-control-sm" rows="2" style="border-radius:8px; font-size:0.82rem;">{{ old('tindak_lanjut', $tindak_lanjut->tindak_lanjut) }}</textarea>
                                                                </td>
                                                                <td>
                                                                    <textarea name="kendala" placeholder="Isi tanda (-)" class="form-control form-control-sm" rows="2" style="border-radius:8px; font-size:0.82rem;">{{ old('kendala', $tindak_lanjut->kendala) }}</textarea>
                                                                </td>
                                                                <td class="text-center">
                                                                    <button class="btn-crud btn-crud-success btn-crud-sm">
                                                                        <i class="fas fa-save mr-1"></i> Simpan
                                                                    </button>
                                                                </td>
                                                            </form>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

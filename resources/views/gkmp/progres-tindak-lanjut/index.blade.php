@extends('layouts.admin.app')

@section('title', 'GKMP Progres Tindak Lanjut')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tindak Lanjut</h3>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-info mb-4">
                            <strong>Progres Prodi:</strong>
                            {{ $persenProdi }}%
                            <span class="ms-2">
                                ({{ $selesai }} dari {{ $total }} tindak lanjut selesai)
                            </span>
                        </div>
                        <div class="accordion" id="accordionKriteria">

                            @foreach ($tindak_lanjuts as $namaKriteria => $kriteria)
                                @php
                                    $collapseId = 'collapseKriteria' . $loop->index;
                                    $headingId = 'headingKriteria' . $loop->index;
                                @endphp

                                <div class="accordion-item mb-3">
                                    {{-- HEADER KRITERIA --}}
                                    <h2 class="accordion-header" id="{{ $headingId }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#{{ $collapseId }}">
                                            <strong>Kriteria:</strong> {{ $namaKriteria }}
                                            <span class="badge bg-primary ms-3">
                                                {{ $kriteria['persen'] }}%
                                            </span>
                                        </button>
                                    </h2>

                                    {{-- BODY KRITERIA --}}
                                    <div id="{{ $collapseId }}" class="accordion-collapse collapse">
                                        <div class="accordion-body">

                                            @foreach ($kriteria['subkriteria'] as $namaSubkriteria => $sub)
                                                <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
                                                    <h5>Subkriteria: {{ $namaSubkriteria }}</h5>
                                                    <span class="badge bg-success">{{ $sub['persen'] }}%</span>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped">
                                                        <thead class="table-secondary">
                                                            <tr>
                                                                <th width="5%">No</th>
                                                                <th width="25%">Hasil Temuan</th>
                                                                <th width="15%">Masukan</th>
                                                                <th width="30%">Tindak Lanjut</th>
                                                                <th width="15%">Kendala</th>
                                                                <th width="10%">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach ($sub['items'] as $tindak_lanjut)
                                                                <tr>
                                                                    <form
                                                                        action="{{ route('gkmp.tindak-lanjut.update', $tindak_lanjut->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <td>{{ $loop->iteration }}</td>

                                                                        <td>
                                                                            {{ $tindak_lanjut->hasilTemuan->hasil_temuan ?? '-' }}
                                                                        </td>

                                                                        <td>
                                                                            <textarea name="masukan" placeholder="jika tidak ada isi tanda (-)" class="form-control" rows="2">{{ old('masukan', $tindak_lanjut->masukan) }}</textarea>
                                                                        </td>

                                                                        <td>
                                                                            <textarea name="tindak_lanjut" placeholder="jika tidak ada isi tanda (-)" class="form-control" rows="2">{{ old('tindak_lanjut', $tindak_lanjut->tindak_lanjut) }}</textarea>
                                                                        </td>

                                                                        <td>
                                                                            <textarea name="kendala" placeholder="jika tidak ada isi tanda (-)" class="form-control" rows="2">{{ old('kendala', $tindak_lanjut->kendala) }}</textarea>
                                                                        </td>

                                                                        <td class="text-center">
                                                                            <button class="btn btn-sm btn-success">
                                                                                Simpan
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
            </div>
        </div>
    </section>
@endsection

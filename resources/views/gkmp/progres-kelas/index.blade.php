@extends('layouts.admin.app')

@section('title', 'GKMP Progres Kelas')

@section('content')
    <section class="content">

        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-chalkboard"></i> Progres Kelas</h5>
                <div class="d-flex gap-2">
                    <a class="btn-crud btn-crud-info btn-crud-sm" href="{{ route('gkmp.progresKelas.downloadAll') }}"><i class="fas fa-download mr-1"></i> Unduh Semua</a>
                    @foreach ($sesiList as $item)
                        <a href="{{ route('gkmp.progresKelas.sesi', $item->sesi) }}" target="_blank" class="btn-crud btn-crud-secondary btn-crud-sm"><i class="fas fa-file-pdf mr-1"></i> Sesi {{ $item->sesi }}</a>
                    @endforeach
                </div>
            </div>
            <div class="crud-card-body">
                <div class="table-responsive">
                    <table class="crud-table">
                        <thead>
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th>Kelas</th>
                                <th>Matakuliah</th>
                                <th>Dosen Pengampu</th>
                                <th class="text-center" width="100">Terlewat</th>
                                <th class="text-center" width="100">Terkumpul</th>
                                <th class="text-center" width="100">Ditugaskan</th>
                                <th>Progres</th>
                                <th class="text-center" width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelasList as $index => $kelas)
                                @php
                                    $data = $progres[$kelas->id] ?? null;
                                    $terlewat = $data->terlewat ?? 0;
                                    $terkumpul = $data->terkumpul ?? 0;
                                    $ditugaskan = $data->ditugaskan ?? 0;
                                    $total = $terkumpul + $ditugaskan;
                                    $persen = $total > 0 ? round(($terkumpul / $total) * 100) : 0;
                                @endphp
                                <tr>
                                    <td class="text-center"><span class="row-num">{{ $index + 1 }}</span></td>
                                    <td class="cell-bold">{{ $kelas->nama_kelas }}</td>
                                    <td>{{ $kelas->matkulDibuka->matkul->nama_matkul ?? '-' }}</td>
                                    <td>{{ $kelas->dosen->name ?? '-' }}</td>
                                    <td class="text-center"><span class="badge-crud badge-crud-danger">{{ $terlewat }}</span></td>
                                    <td class="text-center"><span class="badge-crud badge-crud-success">{{ $terkumpul }}</span></td>
                                    <td class="text-center"><span class="badge-crud badge-crud-info">{{ $ditugaskan }}</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress-thin flex-grow-1 mr-3" style="height:8px;border-radius:4px;background:#e9ecef;overflow:hidden;">
                                                <div class="progress-bar {{ $persen >= 75 ? 'bg-success' : ($persen >= 50 ? 'bg-warning' : 'bg-danger') }}" style="width:{{ $persen }}%;border-radius:4px;"></div>
                                            </div>
                                            <span class="font-weight-bold" style="min-width:45px;text-align:right;color:{{ $persen >= 75 ? '#34a853' : ($persen >= 50 ? '#f09819' : '#ea4335') }};">{{ $persen }}%</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('gkmp.detailKelas.index', $kelas) }}" class="btn-crud btn-crud-info btn-crud-sm"><i class="fas fa-eye mr-1"></i> Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2();
        });
    </script>
@endsection

@extends('layouts.admin.app')

@section('title', 'GKMP Progres Kelas')

@section('content')
    <section class="content">

        {{-- FILTER TAHUN AJARAN --}}
        {{-- <div class="card">
            <div class="card-body">
                <form>
                    <div class="row justify-content-center">
                        <div class="col-md-4">

                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <div class="input-group">
                                    <select class="form-control select2">
                                        <option>2023/2024</option>
                                        <option>2024/2025</option>
                                        <option>2025/2026</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div> --}}

        {{-- HEADER ACTION --}}
        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>
                <a class="btn btn-info">
                    <i class="fas fa-download"></i> Unduh Semua Dokumen
                </a>

                <button class="btn btn-secondary btn-sm">
                    <i class="fas fa-file-pdf"></i> Sesi 1
                </button>
                <button class="btn btn-secondary btn-sm">
                    <i class="fas fa-file-pdf"></i> Sesi 2
                </button>
                <button class="btn btn-secondary btn-sm">
                    <i class="fas fa-file-pdf"></i> Sesi 3
                </button>
                <button class="btn btn-secondary btn-sm">
                    <i class="fas fa-file-pdf"></i> Sesi 4
                </button>
                <button class="btn btn-secondary btn-sm">
                    <i class="fas fa-file-pdf"></i> Sesi 5
                </button>
            </div>

            <div class="d-flex">
                <div class="dropdown mr-2">
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item">Kelas</a>
                        <a class="dropdown-item">Dokumen</a>
                    </div>
                </div>

                {{-- Search --}}
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" placeholder="Search..">
                        <div class="input-group-append">
                            <button class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        {{-- LIST KELAS DUMMY --}}
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-bordered table-striped mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 50px">#</th>
                            <th>Kelas</th>
                            <th>Terlewat</th>
                            <th>Terkumpul</th>
                            <th>Ditugaskan</th>
                            <th>Progres</th>
                            <th class="text-center" style="width: 100px">Aksi</th>
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
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $kelas->nama_kelas }}</strong></td>

                                <td><span class="badge badge-danger">{{ $terlewat }}</span></td>
                                <td><span class="badge badge-success">{{ $terkumpul }}</span></td>
                                <td><span class="badge badge-info">{{ $ditugaskan }}</span></td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-2 font-weight-bold">{{ $persen }}%</div>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('gkmp.detailKelas.index', $kelas) }}" class="btn btn-sm btn-info">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
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
            $('.easy-pie-chart').easyPieChart({
                barColor: '#fadb7d',
                trackColor: '#eeeeee',
                scaleColor: '#dddddd',
                lineWidth: 4,
                size: 80
            });
        });
    </script>
@endsection

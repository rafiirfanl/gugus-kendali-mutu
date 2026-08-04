@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">

            {{-- GKMF Dashboard --}}
            @if($user->hasRole('gkmf'))
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box" style="background-color: #0d6efd; color: white;">
                            <div class="inner">
                                <h3>{{ $totalUsers }}</h3>
                                <p>Total User</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="{{ route('admin.user.index') }}" class="small-box-footer" style="color: white;">
                                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box" style="background-color: #198754; color: white;">
                            <div class="inner">
                                <h3>{{ $totalProdi }}</h3>
                                <p>Total Prodi</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-university"></i>
                            </div>
                            <a href="{{ route('admin.prodi.index') }}" class="small-box-footer" style="color: white;">
                                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box" style="background-color: #ffc107; color: white;">
                            <div class="inner">
                                <h3>{{ $totalMatkul }}</h3>
                                <p>Total Mata Kuliah</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <a href="{{ route('admin.matkul.index') }}" class="small-box-footer" style="color: white;">
                                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box" style="background-color: #dc3545; color: white;">
                            <div class="inner">
                                <h3>{{ $totalKelas }}</h3>
                                <p>Kelas Aktif ({{ $activeTa->tahun_ajaran ?? '-' }})</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-door-open"></i>
                            </div>
                            <a href="{{ route('admin.kelas.index') }}" class="small-box-footer" style="color: white;">
                                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-file-alt mr-1"></i> Progres Dokumen</h3>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <span style="font-size: 2.5rem; font-weight: bold; color: #0d6efd;">{{ $persentaseTerkumpul }}%</span>
                                    <br><small class="text-muted">Terkumpul</small>
                                </div>
                                <div class="progress mb-2" style="height: 20px;">
                                    <div class="progress-bar bg-success" style="width: {{ $persentaseTerkumpul }}%">{{ $dokumenTerkumpul }}</div>
                                    <div class="progress-bar bg-danger" style="width: {{ 100 - $persentaseTerkumpul }}%">{{ $totalDokumenKelas - $dokumenTerkumpul }}</div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-6">
                                        <small class="text-success"><i class="fas fa-check-circle"></i> {{ $dokumenTerkumpul }} Terkumpul</small>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-danger"><i class="fas fa-times-circle"></i> {{ $dokumenDitolak }} Ditolak</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-tasks mr-1"></i> Progres Tindak Lanjut</h3>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <span style="font-size: 2.5rem; font-weight: bold; color: #198754;">{{ $tlPersentase }}%</span>
                                    <br><small class="text-muted">Selesai</small>
                                </div>
                                <div class="progress mb-2" style="height: 20px;">
                                    <div class="progress-bar bg-success" style="width: {{ $tlPersentase }}%">{{ $tlSelesai }}</div>
                                    <div class="progress-bar bg-warning" style="width: {{ 100 - $tlPersentase }}%">{{ $tlTotal - $tlSelesai }}</div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-6">
                                        <small class="text-success"><i class="fas fa-check-circle"></i> {{ $tlSelesai }} Selesai</small>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-warning"><i class="fas fa-clock"></i> {{ $tlTotal - $tlSelesai }} Pending</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-chart-bar mr-1"></i> Ringkasan</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-file-alt text-primary mr-2"></i>
                                        <strong>{{ $totalDokumen }}</strong> Jenis Dokumen
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-book text-warning mr-2"></i>
                                        <strong>{{ $totalMatkul }}</strong> Mata Kuliah
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-door-open text-danger mr-2"></i>
                                        <strong>{{ $totalKelas }}</strong> Kelas Aktif
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-users text-success mr-2"></i>
                                        <strong>{{ $totalUsers }}</strong> User Terdaftar
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i> Progres Dokumen Per Prodi</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead style="background-color: #0c3366; color: white;">
                                            <tr>
                                                <th class="text-center" width="50">No</th>
                                                <th>Prodi</th>
                                                <th class="text-center" width="120">Total</th>
                                                <th class="text-center" width="120">Terkumpul</th>
                                                <th class="text-center" width="150">Progres</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($prodiStats as $index => $prodi)
                                                <tr>
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td>{{ $prodi['nama'] }}</td>
                                                    <td class="text-center">{{ $prodi['total'] }}</td>
                                                    <td class="text-center">{{ $prodi['terkumpul'] }}</td>
                                                    <td>
                                                        <div class="progress" style="height: 20px;">
                                                            <div class="progress-bar {{ $prodi['persentase'] >= 75 ? 'bg-success' : ($prodi['persentase'] >= 50 ? 'bg-warning' : 'bg-danger') }}"
                                                                style="width: {{ $prodi['persentase'] }}%">
                                                                {{ $prodi['persentase'] }}%
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center text-muted">Belum ada data</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- GKMP Dashboard --}}
            @if($user->hasRole('gkmp'))
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box" style="background-color: #0d6efd; color: white;">
                            <div class="inner">
                                <h3>{{ $totalMatkul }}</h3>
                                <p>Mata Kuliah</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <a href="{{ route('admin.matkul.index') }}" class="small-box-footer" style="color: white;">
                                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box" style="background-color: #198754; color: white;">
                            <div class="inner">
                                <h3>{{ $totalKelas }}</h3>
                                <p>Kelas Aktif</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-door-open"></i>
                            </div>
                            <a href="{{ route('gkmp.progresKelas.index') }}" class="small-box-footer" style="color: white;">
                                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box" style="background-color: #ffc107; color: white;">
                            <div class="inner">
                                <h3>{{ $totalDosen }}</h3>
                                <p>Dosen</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <a href="{{ route('admin.user.index') }}" class="small-box-footer" style="color: white;">
                                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box" style="background-color: #dc3545; color: white;">
                            <div class="inner">
                                <h3>{{ $persentaseTerkumpul }}%</h3>
                                <p>Dokumen Terkumpul</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file-upload"></i>
                            </div>
                            <a href="{{ route('gkmp.progresKelas.index') }}" class="small-box-footer" style="color: white;">
                                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-file-alt mr-1"></i> Status Dokumen</h3>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <span style="font-size: 2.5rem; font-weight: bold; color: #0d6efd;">{{ $persentaseTerkumpul }}%</span>
                                    <br><small class="text-muted">Terkumpul</small>
                                </div>
                                <div class="progress mb-3" style="height: 25px;">
                                    <div class="progress-bar bg-success" style="width: {{ $persentaseTerkumpul }}%">{{ $dokumenTerkumpul }} Terkumpul</div>
                                    <div class="progress-bar bg-danger" style="width: {{ 100 - $persentaseTerkumpul }}%">{{ $dokumenDitolak }} Ditolak</div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-4">
                                        <h4 class="text-primary">{{ $totalDokumenKelas }}</h4>
                                        <small class="text-muted">Total</small>
                                    </div>
                                    <div class="col-4">
                                        <h4 class="text-success">{{ $dokumenTerkumpul }}</h4>
                                        <small class="text-muted">Terkumpul</small>
                                    </div>
                                    <div class="col-4">
                                        <h4 class="text-danger">{{ $dokumenDitolak }}</h4>
                                        <small class="text-muted">Ditolak</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-tasks mr-1"></i> Progres Tindak Lanjut</h3>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <span style="font-size: 2.5rem; font-weight: bold; color: #198754;">{{ $tlPersentase }}%</span>
                                    <br><small class="text-muted">Selesai</small>
                                </div>
                                <div class="progress mb-3" style="height: 25px;">
                                    <div class="progress-bar bg-success" style="width: {{ $tlPersentase }}%">{{ $tlSelesai }} Selesai</div>
                                    <div class="progress-bar bg-warning" style="width: {{ 100 - $tlPersentase }}%">{{ $tlTotal - $tlSelesai }} Pending</div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-4">
                                        <h4 class="text-primary">{{ $tlTotal }}</h4>
                                        <small class="text-muted">Total</small>
                                    </div>
                                    <div class="col-4">
                                        <h4 class="text-success">{{ $tlSelesai }}</h4>
                                        <small class="text-muted">Selesai</small>
                                    </div>
                                    <div class="col-4">
                                        <h4 class="text-warning">{{ $tlTotal - $tlSelesai }}</h4>
                                        <small class="text-muted">Pending</small>
                                    </div>
                                </div>
                                <div class="mt-3 text-center">
                                    <a href="{{ route('gkmp.tindak-lanjut.index') }}" class="btn btn-sm btn-outline-success">
                                        <i class="fas fa-external-link-alt mr-1"></i> Kelola Tindak Lanjut
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-list mr-1"></i> Daftar Kelas ({{ $activeTa->tahun_ajaran ?? '-' }})</h3>
                                <div class="card-tools">
                                    <a href="{{ route('gkmp.progresKelas.index') }}" class="btn btn-tool btn-sm">
                                        <i class="fas fa-external-link-alt"></i> Lihat Semua
                                    </a>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead style="background-color: #0c3366; color: white;">
                                        <tr>
                                            <th class="text-center" width="50">No</th>
                                            <th>Kelas</th>
                                            <th>Mata Kuliah</th>
                                            <th>Dosen</th>
                                            <th class="text-center" width="100">Terkumpul</th>
                                            <th class="text-center" width="150">Progres</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($kelasList as $index => $kelas)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>{{ $kelas['nama'] }}</td>
                                                <td>{{ $kelas['matkul'] }}</td>
                                                <td>{{ $kelas['dosen'] }}</td>
                                                <td class="text-center">{{ $kelas['terkumpul'] }}/{{ $kelas['total'] }}</td>
                                                <td>
                                                    <div class="progress" style="height: 18px;">
                                                        <div class="progress-bar {{ $kelas['persentase'] >= 75 ? 'bg-success' : ($kelas['persentase'] >= 50 ? 'bg-warning' : 'bg-danger') }}"
                                                            style="width: {{ $kelas['persentase'] }}%">
                                                            {{ $kelas['persentase'] }}%
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">Belum ada kelas aktif</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Kaprodi Dashboard --}}
            @if($user->hasRole('kaprodi'))
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <div class="small-box" style="background-color: #0d6efd; color: white;">
                            <div class="inner">
                                <h3>{{ $totalMatkul }}</h3>
                                <p>Mata Kuliah</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <a href="{{ route('admin.matkul.index') }}" class="small-box-footer" style="color: white;">
                                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box" style="background-color: #198754; color: white;">
                            <div class="inner">
                                <h3>{{ $totalDosen }}</h3>
                                <p>Dosen</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <a href="{{ route('admin.user.index') }}" class="small-box-footer" style="color: white;">
                                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box" style="background-color: #ffc107; color: white;">
                            <div class="inner">
                                <h3>{{ $totalKelas }}</h3>
                                <p>Kelas Aktif</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-door-open"></i>
                            </div>
                            <a href="{{ route('gkmp.progresKelas.index') }}" class="small-box-footer" style="color: white;">
                                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-file-alt mr-1"></i> Progres Dokumen Per Sesi</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @for($sesi = 1; $sesi <= 4; $sesi++)
                                        <div class="col-md-3">
                                            <div class="text-center p-3 border rounded" style="background-color: {{ $dokumenPerSesi[$sesi]['persentase'] >= 75 ? '#d1e7dd' : ($dokumenPerSesi[$sesi]['persentase'] >= 50 ? '#fff3cd' : '#f8d7da') }};">
                                                <h5 class="font-weight-bold">Sesi {{ $sesi }}</h5>
                                                <span style="font-size: 2rem; font-weight: bold;">{{ $dokumenPerSesi[$sesi]['persentase'] }}%</span>
                                                <div class="progress mt-2" style="height: 10px;">
                                                    <div class="progress-bar {{ $dokumenPerSesi[$sesi]['persentase'] >= 75 ? 'bg-success' : ($dokumenPerSesi[$sesi]['persentase'] >= 50 ? 'bg-warning' : 'bg-danger') }}"
                                                        style="width: {{ $dokumenPerSesi[$sesi]['persentase'] }}%"></div>
                                                </div>
                                                <small class="text-muted">{{ $dokumenPerSesi[$sesi]['terkumpul'] }}/{{ $dokumenPerSesi[$sesi]['total'] }} dokumen</small>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-chart-bar mr-1"></i> Ringkasan Status Dokumen</h3>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <span style="font-size: 2.5rem; font-weight: bold; color: #0d6efd;">{{ $persentaseTerkumpul }}%</span>
                                    <br><small class="text-muted">Total Progres</small>
                                </div>
                                <div class="progress mb-3" style="height: 25px;">
                                    <div class="progress-bar bg-success" style="width: {{ $persentaseTerkumpul }}%">{{ $dokumenTerkumpul }}</div>
                                    <div class="progress-bar bg-secondary" style="width: {{ 100 - $persentaseTerkumpul }}%">{{ $totalDokumenKelas - $dokumenTerkumpul }}</div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-6">
                                        <h4 class="text-primary">{{ $totalDokumenKelas }}</h4>
                                        <small class="text-muted">Total Dokumen</small>
                                    </div>
                                    <div class="col-6">
                                        <h4 class="text-success">{{ $dokumenTerkumpul }}</h4>
                                        <small class="text-muted">Terkumpul</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-list mr-1"></i> Kelas Terbaru</h3>
                                <div class="card-tools">
                                    <a href="{{ route('gkmp.progresKelas.index') }}" class="btn btn-tool btn-sm">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead style="background-color: #198754; color: white;">
                                        <tr>
                                            <th>Kelas</th>
                                            <th>Mata Kuliah</th>
                                            <th>Dosen</th>
                                            <th class="text-center">Progres</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($kelasList->take(5) as $kelas)
                                            <tr>
                                                <td>{{ $kelas['nama'] }}</td>
                                                <td>{{ $kelas['matkul'] }}</td>
                                                <td>{{ $kelas['dosen'] }}</td>
                                                <td class="text-center">
                                                    <span class="badge {{ $kelas['persentase'] >= 75 ? 'badge-success' : ($kelas['persentase'] >= 50 ? 'badge-warning' : 'badge-danger') }}">
                                                        {{ $kelas['persentase'] }}%
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">Belum ada kelas</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Dosen Dashboard --}}
            @if($user->hasRole('dosen'))
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <div class="small-box" style="background-color: #0d6efd; color: white;">
                            <div class="inner">
                                <h3>{{ $totalKelas }}</h3>
                                <p>Kelas Diampu</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-door-open"></i>
                            </div>
                            <a href="{{ route('dosen.kelasDiampu.index') }}" class="small-box-footer" style="color: white;">
                                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box" style="background-color: #198754; color: white;">
                            <div class="inner">
                                <h3>{{ $persentaseTerkumpul }}%</h3>
                                <p>Dokumen Terkumpul</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file-upload"></i>
                            </div>
                            <a href="{{ route('dosen.kelasDiampu.index') }}" class="small-box-footer" style="color: white;">
                                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box" style="background-color: #dc3545; color: white;">
                            <div class="inner">
                                <h3>{{ $dokumenPending }}</h3>
                                <p>Dokumen Perlu Revisi</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <a href="{{ route('dosen.kelasDiampu.index') }}" class="small-box-footer" style="color: white;">
                                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-file-alt mr-1"></i> Status Pengumpulan Dokumen</h3>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <span style="font-size: 2.5rem; font-weight: bold; color: #0d6efd;">{{ $persentaseTerkumpul }}%</span>
                                    <br><small class="text-muted">Terkumpul</small>
                                </div>
                                <div class="progress mb-3" style="height: 25px;">
                                    <div class="progress-bar bg-success" style="width: {{ $persentaseTerkumpul }}%">{{ $dokumenTerkumpul }} Terkumpul</div>
                                    <div class="progress-bar bg-danger" style="width: {{ 100 - $persentaseTerkumpul }}%">{{ $dokumenPending }} Revisi</div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-4">
                                        <h4 class="text-primary">{{ $totalDokumen }}</h4>
                                        <small class="text-muted">Total</small>
                                    </div>
                                    <div class="col-4">
                                        <h4 class="text-success">{{ $dokumenTerkumpul }}</h4>
                                        <small class="text-muted">Terkumpul</small>
                                    </div>
                                    <div class="col-4">
                                        <h4 class="text-danger">{{ $dokumenPending }}</h4>
                                        <small class="text-muted">Revisi</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-history mr-1"></i> Riwayat Dokumen</h3>
                                <div class="card-tools">
                                    <a href="{{ route('dosen.riwayatDokumen.index') }}" class="btn btn-tool btn-sm">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li class="mb-3 pb-3 border-bottom">
                                        <a href="{{ route('dosen.kelasDiampu.index') }}" class="text-decoration-none">
                                            <i class="fas fa-door-open text-primary mr-2"></i>
                                            <strong>Kelas Diampu</strong>
                                            <br><small class="text-muted ml-4">Lihat kelas yang Anda ampu dan status dokumen</small>
                                        </a>
                                    </li>
                                    <li class="mb-3 pb-3 border-bottom">
                                        <a href="{{ route('dosen.riwayatDokumen.index') }}" class="text-decoration-none">
                                            <i class="fas fa-history text-success mr-2"></i>
                                            <strong>Riwayat Dokumen</strong>
                                            <br><small class="text-muted ml-4">Lihat riwayat pengumpulan dokumen Anda</small>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('profile.edit') }}" class="text-decoration-none">
                                            <i class="fas fa-user-cog text-warning mr-2"></i>
                                            <strong>Profil Saya</strong>
                                            <br><small class="text-muted ml-4">Kelola informasi profil Anda</small>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                @if($kelasList->count() > 0)
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-list mr-1"></i> Kelas Diampu ({{ $activeTa->tahun_ajaran ?? '-' }})</h3>
                                    <div class="card-tools">
                                        <a href="{{ route('dosen.kelasDiampu.index') }}" class="btn btn-tool btn-sm">
                                            <i class="fas fa-external-link-alt"></i> Lihat Semua
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead style="background-color: #0c3366; color: white;">
                                            <tr>
                                                <th class="text-center" width="50">No</th>
                                                <th>Kelas</th>
                                                <th>Mata Kuliah</th>
                                                <th class="text-center" width="100">Terkumpul</th>
                                                <th class="text-center" width="100">Revisi</th>
                                                <th class="text-center" width="150">Progres</th>
                                                <th class="text-center" width="100">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($kelasList as $index => $kelas)
                                                <tr>
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td>{{ $kelas['nama'] }}</td>
                                                    <td>{{ $kelas['matkul'] }}</td>
                                                    <td class="text-center"><span class="badge badge-success">{{ $kelas['terkumpul'] }}</span></td>
                                                    <td class="text-center"><span class="badge badge-danger">{{ $kelas['pending'] }}</span></td>
                                                    <td>
                                                        <div class="progress" style="height: 18px;">
                                                            <div class="progress-bar {{ $kelas['persentase'] >= 75 ? 'bg-success' : ($kelas['persentase'] >= 50 ? 'bg-warning' : 'bg-danger') }}"
                                                                style="width: {{ $kelas['persentase'] }}%">
                                                                {{ $kelas['persentase'] }}%
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('dosen.kelasDiampu.show', $kelas['id']) }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

        </div>
    </section>
@endsection

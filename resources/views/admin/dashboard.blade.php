@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
    <style>
        /* ============================================
           DASHBOARD GLOBAL STYLES
           ============================================ */
        :root {
            --primary: #0c3366;
            --primary-light: #1a5276;
            --accent: #1a73e8;
            --success: #34a853;
            --warning: #fbbc04;
            --danger: #ea4335;
            --info: #4285f4;
            --purple: #7c3aed;
            --text-dark: #1a1a2e;
            --text-muted: #6c757d;
            --border-light: #e9ecef;
            --bg-light: #f8f9fc;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
            --shadow-lg: 0 8px 25px rgba(0,0,0,0.12);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
        }

        /* ============================================
           STAT CARDS
           ============================================ */
        .dashboard-stat {
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            min-height: 110px;
        }
        .dashboard-stat:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }
        .dashboard-stat .inner {
            padding: 22px 24px;
            position: relative;
            z-index: 1;
        }
        .dashboard-stat .inner h3 {
            font-size: 2rem;
            font-weight: 800;
            margin: 0 0 4px 0;
            line-height: 1;
            letter-spacing: -0.5px;
        }
        .dashboard-stat .inner p {
            margin: 0;
            font-size: 0.88rem;
            opacity: 0.9;
            font-weight: 500;
        }
        .dashboard-stat .icon-wrap {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .dashboard-stat .icon-wrap i {
            font-size: 1.6rem;
            opacity: 0.85;
        }
        .dashboard-stat .stat-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 24px;
            background: rgba(0,0,0,0.1);
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.3px;
            transition: all 0.2s;
        }
        .dashboard-stat .stat-footer:hover {
            background: rgba(0,0,0,0.2);
            color: white;
        }
        .stat-blue { background: linear-gradient(135deg, #1a73e8 0%, #0d5bbd 100%); color: white; }
        .stat-green { background: linear-gradient(135deg, #34a853 0%, #1e8e3e 100%); color: white; }
        .stat-orange { background: linear-gradient(135deg, #fbbc04 0%, #f09819 100%); color: #1a1a2e; }
        .stat-red { background: linear-gradient(135deg, #ea4335 0%, #d32f2f 100%); color: white; }
        .stat-purple { background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%); color: white; }
        .stat-teal { background: linear-gradient(135deg, #009688 0%, #00796b 100%); color: white; }

        /* ============================================
           CARDS
           ============================================ */
        .card-dashboard {
            border: none;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: box-shadow 0.2s;
        }
        .card-dashboard:hover {
            box-shadow: var(--shadow-md);
        }
        .card-dashboard .card-header {
            border-bottom: 2px solid var(--border-light);
            padding: 16px 22px;
            background: white;
        }
        .card-dashboard .card-header .card-title {
            font-weight: 700;
            font-size: 0.95rem;
            margin: 0;
            color: var(--text-dark);
        }
        .card-dashboard .card-body {
            padding: 22px;
        }

        /* ============================================
           TABLES
           ============================================ */
        .table-dashboard {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            margin: 0;
        }
        .table-dashboard thead th {
            background: var(--primary);
            color: white;
            font-weight: 600;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 13px 18px;
            border: none;
            white-space: nowrap;
            position: sticky;
            top: 0;
            z-index: 1;
        }
        .table-dashboard thead th:first-child { border-radius: var(--radius-sm) 0 0 0; }
        .table-dashboard thead th:last-child { border-radius: 0 var(--radius-sm) 0 0; }
        .table-dashboard tbody td {
            padding: 14px 18px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-light);
            font-size: 0.88rem;
            color: var(--text-dark);
            transition: background 0.15s;
        }
        .table-dashboard tbody tr {
            transition: all 0.15s;
        }
        .table-dashboard tbody tr:hover {
            background-color: #f0f4ff;
        }
        .table-dashboard tbody tr:last-child td {
            border-bottom: none;
        }
        .table-dashboard tbody tr:last-child td:first-child { border-radius: 0 0 0 var(--radius-sm); }
        .table-dashboard tbody tr:last-child td:last-child { border-radius: 0 0 var(--radius-sm) 0; }
        .table-dashboard .row-num {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--border-light);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            color: var(--text-muted);
        }
        .table-dashboard .cell-primary {
            font-weight: 600;
            color: var(--text-dark);
        }
        .table-dashboard .cell-secondary {
            color: var(--text-muted);
            font-size: 0.82rem;
        }

        /* ============================================
           BUTTONS
           ============================================ */
        .btn-dashboard {
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.82rem;
            padding: 7px 16px;
            letter-spacing: 0.3px;
            transition: all 0.2s;
            border: none;
            box-shadow: var(--shadow-sm);
        }
        .btn-dashboard:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-1px);
        }
        .btn-dashboard-primary {
            background: var(--accent);
            color: white;
        }
        .btn-dashboard-primary:hover {
            background: #1557b0;
            color: white;
        }
        .btn-dashboard-success {
            background: var(--success);
            color: white;
        }
        .btn-dashboard-success:hover {
            background: #2d9249;
            color: white;
        }
        .btn-dashboard-outline {
            background: transparent;
            border: 1.5px solid var(--accent);
            color: var(--accent);
        }
        .btn-dashboard-outline:hover {
            background: var(--accent);
            color: white;
        }
        .btn-dashboard-outline-success {
            background: transparent;
            border: 1.5px solid var(--success);
            color: var(--success);
        }
        .btn-dashboard-outline-success:hover {
            background: var(--success);
            color: white;
        }
        .btn-dashboard-sm {
            padding: 5px 12px;
            font-size: 0.78rem;
            border-radius: 6px;
        }
        .btn-dashboard-icon {
            width: 34px;
            height: 34px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 0.85rem;
        }

        /* ============================================
           BADGES
           ============================================ */
        .badge-dashboard {
            display: inline-flex;
            align-items: center;
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            line-height: 1.2;
        }
        .badge-dashboard-success {
            background: #e8f5e9;
            color: #1b7a35;
        }
        .badge-dashboard-danger {
            background: #fce4ec;
            color: #c62828;
        }
        .badge-dashboard-warning {
            background: #fff8e1;
            color: #e65100;
        }
        .badge-dashboard-info {
            background: #e3f2fd;
            color: #1565c0;
        }
        .badge-dashboard-primary {
            background: #e8eaf6;
            color: #283593;
        }
        .badge-dashboard-purple {
            background: #f3e5f5;
            color: #6a1b9a;
        }
        .badge-dashboard-sm {
            padding: 3px 8px;
            font-size: 0.72rem;
            border-radius: 6px;
        }

        /* ============================================
           PROGRESS BARS
           ============================================ */
        .progress-modern {
            height: 24px;
            border-radius: 12px;
            background: var(--border-light);
            overflow: hidden;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.08);
        }
        .progress-modern .progress-bar {
            border-radius: 12px;
            font-size: 0.78rem;
            font-weight: 700;
            line-height: 24px;
            transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .progress-thin {
            height: 8px;
            border-radius: 4px;
            background: var(--border-light);
            overflow: hidden;
        }
        .progress-thin .progress-bar {
            border-radius: 4px;
            transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ============================================
           PERCENTAGE CIRCLE
           ============================================ */
        .percentage-circle {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            font-weight: 800;
            position: relative;
        }
        .percentage-circle::before {
            content: '';
            position: absolute;
            inset: 4px;
            border-radius: 50%;
            background: white;
        }
        .percentage-circle span {
            position: relative;
            z-index: 1;
            letter-spacing: -0.5px;
        }

        /* ============================================
           SESI CARDS
           ============================================ */
        .sesi-card {
            border-radius: var(--radius-md);
            padding: 28px 18px;
            text-align: center;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0,0,0,0.06);
            position: relative;
            overflow: hidden;
        }
        .sesi-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }
        .sesi-card h5 {
            font-weight: 700;
            margin-bottom: 12px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .sesi-card .sesi-percent {
            font-size: 2.4rem;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -1px;
        }
        .sesi-card .sesi-detail {
            font-size: 0.78rem;
            margin-top: 10px;
            font-weight: 500;
        }

        /* ============================================
           SUMMARY ITEMS
           ============================================ */
        .summary-item {
            display: flex;
            align-items: center;
            padding: 14px 18px;
            border-radius: var(--radius-sm);
            margin-bottom: 8px;
            transition: all 0.15s;
            border: 1px solid var(--border-light);
            background: white;
        }
        .summary-item:last-child { margin-bottom: 0; }
        .summary-item:hover {
            background: #f0f4ff;
            border-color: #c5d5f5;
            transform: translateX(3px);
        }
        .summary-item .summary-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 14px;
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        .summary-item .summary-text strong {
            font-size: 1.15rem;
            display: block;
            line-height: 1.2;
            color: var(--text-dark);
        }
        .summary-item .summary-text small {
            color: var(--text-muted);
            font-size: 0.8rem;
        }

        /* ============================================
           QUICK LINKS
           ============================================ */
        .quick-link {
            display: flex;
            align-items: center;
            padding: 16px 18px;
            border-radius: var(--radius-sm);
            margin-bottom: 10px;
            border: 1px solid var(--border-light);
            text-decoration: none;
            color: inherit;
            transition: all 0.2s;
            background: white;
        }
        .quick-link:last-child { margin-bottom: 0; }
        .quick-link:hover {
            background: #f0f4ff;
            border-color: #c5d5f5;
            text-decoration: none;
            color: inherit;
            transform: translateX(4px);
            box-shadow: var(--shadow-sm);
        }
        .quick-link .ql-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 14px;
            font-size: 1rem;
            flex-shrink: 0;
        }
        .quick-link .ql-text strong {
            display: block;
            font-size: 0.92rem;
            margin-bottom: 2px;
            color: var(--text-dark);
        }
        .quick-link .ql-text small {
            color: var(--text-muted);
            font-size: 0.78rem;
        }

        /* ============================================
           STAT BOX (summary counter)
           ============================================ */
        .stat-box {
            padding: 14px;
            border-radius: var(--radius-sm);
            text-align: center;
            transition: transform 0.2s;
        }
        .stat-box:hover {
            transform: scale(1.02);
        }
        .stat-box h4 {
            margin: 0 0 2px;
            font-weight: 800;
            font-size: 1.5rem;
            line-height: 1.2;
        }
        .stat-box small {
            font-size: 0.78rem;
            font-weight: 500;
        }

        /* ============================================
           WELCOME BANNER
           ============================================ */
        .welcome-banner {
            border-radius: var(--radius-md);
            color: white;
            border: none;
            position: relative;
            overflow: hidden;
        }
        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }
        .welcome-banner::after {
            content: '';
            position: absolute;
            bottom: -60%;
            right: 5%;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.03);
        }
        .welcome-banner h4 {
            margin: 0;
            font-weight: 700;
            font-size: 1.2rem;
        }
        .welcome-banner p {
            margin: 6px 0 0;
            opacity: 0.85;
            font-size: 0.92rem;
        }
        /* ============================================
           EMPTY STATE
           ============================================ */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-muted);
        }
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 12px;
            opacity: 0.4;
        }
        .empty-state p {
            margin: 0;
            font-size: 0.9rem;
        }

        /* ============================================
           SECTION HEADER
           ============================================ */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }
        .section-header h3 {
            font-weight: 700;
            font-size: 1rem;
            margin: 0;
            color: var(--text-dark);
        }
    </style>

    <section class="content">
        <div class="container-fluid">

            {{-- ==========================================
                 GKMF DASHBOARD
                 ========================================== --}}
            @if($user->hasRole('gkmf'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card card-dashboard welcome-banner" style="background: linear-gradient(135deg, #0c3366 0%, #1a5276 50%, #2471a3 100%);">
                            <div class="card-body py-4 px-5 d-flex justify-content-between align-items-center">
                                <div>
                                    <h4>Selamat Datang, {{ $user->name }}</h4>
                                    <p>Tahun Ajaran Aktif: <strong>{{ $activeTa->tahun_ajaran ?? '-' }} ({{ $activeTa->jenis ?? '-' }})</strong></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-3">
                        <div class="dashboard-stat stat-blue">
                            <div class="inner">
                                <h3>{{ $totalUsers }}</h3>
                                <p>Total User</p>
                            </div>
                            <div class="icon-wrap"><i class="fas fa-users"></i></div>
                            <a href="{{ route('admin.user.index') }}" class="stat-footer">
                                <span>Lihat Detail</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-3">
                        <div class="dashboard-stat stat-green">
                            <div class="inner">
                                <h3>{{ $totalProdi }}</h3>
                                <p>Total Prodi</p>
                            </div>
                            <div class="icon-wrap"><i class="fas fa-university"></i></div>
                            <a href="{{ route('admin.prodi.index') }}" class="stat-footer">
                                <span>Lihat Detail</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-3">
                        <div class="dashboard-stat stat-orange">
                            <div class="inner">
                                <h3>{{ $totalDokumen }}</h3>
                                <p>Jenis Dokumen</p>
                            </div>
                            <div class="icon-wrap"><i class="fas fa-file-alt"></i></div>
                            <a href="{{ route('admin.dokumenPerkuliahan.index') }}" class="stat-footer">
                                <span>Lihat Detail</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-lg-6 col-md-6 mb-3">
                        <div class="card card-dashboard h-100">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-tasks text-success mr-2"></i>Tindak Lanjut</h3>
                            </div>
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    @php $tlColor = $tlPersentase >= 75 ? '#34a853' : ($tlPersentase >= 50 ? '#fbbc04' : '#ea4335'); @endphp
                                    <div class="percentage-circle mx-auto" style="border: 4px solid {{ $tlColor }};">
                                        <span style="color: {{ $tlColor }};">{{ $tlPersentase }}%</span>
                                    </div>
                                </div>
                                <div class="progress-modern mb-3">
                                    <div class="progress-bar bg-success" style="width: {{ $tlPersentase }}%"></div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="stat-box" style="background: #e8f5e9;">
                                            <h4 style="color: #34a853;">{{ $tlSelesai }}</h4>
                                            <small class="text-success">Selesai</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="stat-box" style="background: #fff8e1;">
                                            <h4 style="color: #f09819;">{{ $tlTotal - $tlSelesai }}</h4>
                                            <small class="text-warning">Pending</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

            {{-- ==========================================
                 GKMP DASHBOARD
                 ========================================== --}}
            @if($user->hasRole('gkmp'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card card-dashboard welcome-banner" style="background: linear-gradient(135deg, #0c3366 0%, #1a5276 50%, #2471a3 100%);">
                            <div class="card-body py-4 px-5 d-flex justify-content-between align-items-center">
                                <div>
                                    <h4>Selamat Datang, {{ $user->name }}</h4>
                                    <p>Gugus Kendali Mutu Prodi &bull; TA <strong>{{ $activeTa->tahun_ajaran ?? '-' }}</strong></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="dashboard-stat stat-blue">
                            <div class="inner"><h3>{{ $totalMatkul }}</h3><p>Mata Kuliah</p></div>
                            <div class="icon-wrap"><i class="fas fa-book"></i></div>
                            <a href="{{ route('admin.matkul.index') }}" class="stat-footer"><span>Lihat Detail</span><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="dashboard-stat stat-green">
                            <div class="inner"><h3>{{ $totalKelas }}</h3><p>Kelas Aktif</p></div>
                            <div class="icon-wrap"><i class="fas fa-door-open"></i></div>
                            <a href="{{ route('gkmp.progresKelas.index') }}" class="stat-footer"><span>Lihat Detail</span><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="dashboard-stat stat-orange">
                            <div class="inner"><h3>{{ $totalDosen }}</h3><p>Dosen</p></div>
                            <div class="icon-wrap"><i class="fas fa-chalkboard-teacher"></i></div>
                            <a href="{{ route('admin.user.index') }}" class="stat-footer"><span>Lihat Detail</span><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="dashboard-stat stat-purple">
                            <div class="inner"><h3>{{ $persentaseTerkumpul }}%</h3><p>Dokumen Terkumpul</p></div>
                            <div class="icon-wrap"><i class="fas fa-file-upload"></i></div>
                            <a href="{{ route('gkmp.progresKelas.index') }}" class="stat-footer"><span>Lihat Detail</span><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-lg-6 mb-3">
                        <div class="card card-dashboard h-100">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-file-alt text-primary mr-2"></i>Status Dokumen</h3>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <div class="percentage-circle mx-auto" style="border: 4px solid #1a73e8;">
                                        <span style="color: #1a73e8;">{{ $persentaseTerkumpul }}%</span>
                                    </div>
                                    <p class="mt-2 mb-0 cell-secondary">Tingkat Pengumpulan</p>
                                </div>
                                <div class="progress-modern mb-4">
                                    <div class="progress-bar bg-success" style="width: {{ $persentaseTerkumpul }}%"></div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-4">
                                        <div class="stat-box" style="background: #e3f2fd;">
                                            <h4 style="color: #1a73e8;">{{ $totalDokumenKelas }}</h4>
                                            <small class="cell-secondary">Total</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-box" style="background: #e8f5e9;">
                                            <h4 style="color: #34a853;">{{ $dokumenTerkumpul }}</h4>
                                            <small class="cell-secondary">Terkumpul</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-box" style="background: #fce4ec;">
                                            <h4 style="color: #ea4335;">{{ $dokumenDitolak }}</h4>
                                            <small class="cell-secondary">Ditolak</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <div class="card card-dashboard h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title"><i class="fas fa-tasks text-success mr-2"></i>Tindak Lanjut</h3>
                                <a href="{{ route('gkmp.tindak-lanjut.index') }}" class="btn-dashboard btn-dashboard-outline-success btn-dashboard-sm">
                                    <i class="fas fa-external-link-alt mr-1"></i> Kelola
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    @php $tlColor = $tlPersentase >= 75 ? '#34a853' : ($tlPersentase >= 50 ? '#fbbc04' : '#ea4335'); @endphp
                                    <div class="percentage-circle mx-auto" style="border: 4px solid {{ $tlColor }};">
                                        <span style="color: {{ $tlColor }};">{{ $tlPersentase }}%</span>
                                    </div>
                                    <p class="mt-2 mb-0 cell-secondary">Tingkat Penyelesaian</p>
                                </div>
                                <div class="progress-modern mb-4">
                                    <div class="progress-bar bg-success" style="width: {{ $tlPersentase }}%"></div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-4">
                                        <div class="stat-box" style="background: #e3f2fd;">
                                            <h4 style="color: #1a73e8;">{{ $tlTotal }}</h4>
                                            <small class="cell-secondary">Total</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-box" style="background: #e8f5e9;">
                                            <h4 style="color: #34a853;">{{ $tlSelesai }}</h4>
                                            <small class="cell-secondary">Selesai</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-box" style="background: #fff8e1;">
                                            <h4 style="color: #f09819;">{{ $tlTotal - $tlSelesai }}</h4>
                                            <small class="cell-secondary">Pending</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card card-dashboard">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title"><i class="fas fa-list text-primary mr-2"></i>Daftar Kelas</h3>
                                <div class="d-flex align-items-center">
                                    <span class="badge-dashboard badge-dashboard-primary mr-2">{{ $activeTa->tahun_ajaran ?? '-' }}</span>
                                    <a href="{{ route('gkmp.progresKelas.index') }}" class="btn-dashboard btn-dashboard-outline btn-dashboard-sm">
                                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table-dashboard mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="60">No</th>
                                                <th>Kelas</th>
                                                <th>Mata Kuliah</th>
                                                <th>Dosen</th>
                                                <th class="text-center" width="100">Terkumpul</th>
                                                <th width="240">Progres</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($kelasList as $index => $kelas)
                                                <tr>
                                                    <td class="text-center"><span class="row-num">{{ $index + 1 }}</span></td>
                                                    <td class="cell-primary">{{ $kelas['nama'] }}</td>
                                                    <td>{{ $kelas['matkul'] }}</td>
                                                    <td class="cell-secondary">{{ $kelas['dosen'] }}</td>
                                                    <td class="text-center"><span class="badge-dashboard badge-dashboard-success">{{ $kelas['terkumpul'] }}/{{ $kelas['total'] }}</span></td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="progress-thin flex-grow-1 mr-3">
                                                                <div class="progress-bar {{ $kelas['persentase'] >= 75 ? 'bg-success' : ($kelas['persentase'] >= 50 ? 'bg-warning' : 'bg-danger') }}" style="width: {{ $kelas['persentase'] }}%"></div>
                                                            </div>
                                                            <span class="font-weight-bold" style="min-width: 45px; text-align: right; color: {{ $kelas['persentase'] >= 75 ? '#34a853' : ($kelas['persentase'] >= 50 ? '#f09819' : '#ea4335') }};">
                                                                {{ $kelas['persentase'] }}%
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="empty-state">
                                                            <i class="fas fa-inbox d-block"></i>
                                                            <p>Belum ada kelas aktif</p>
                                                        </div>
                                                    </td>
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

            {{-- ==========================================
                 KAPRODI DASHBOARD
                 ========================================== --}}
            @if($user->hasRole('kaprodi'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card card-dashboard welcome-banner" style="background: linear-gradient(135deg, #0c3366 0%, #1a5276 50%, #2471a3 100%);">
                            <div class="card-body py-4 px-5 d-flex justify-content-between align-items-center">
                                <div>
                                    <h4>Selamat Datang, {{ $user->name }}</h4>
                                    <p>Kepala Program Studi &bull; TA <strong>{{ $activeTa->tahun_ajaran ?? '-' }}</strong></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="dashboard-stat stat-blue">
                            <div class="inner"><h3>{{ $totalMatkul }}</h3><p>Mata Kuliah</p></div>
                            <div class="icon-wrap"><i class="fas fa-book"></i></div>
                            <a href="{{ route('admin.matkul.index') }}" class="stat-footer"><span>Lihat Detail</span><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="dashboard-stat stat-green">
                            <div class="inner"><h3>{{ $totalDosen }}</h3><p>Dosen</p></div>
                            <div class="icon-wrap"><i class="fas fa-chalkboard-teacher"></i></div>
                            <a href="{{ route('admin.user.index') }}" class="stat-footer"><span>Lihat Detail</span><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="dashboard-stat stat-orange">
                            <div class="inner"><h3>{{ $totalKelas }}</h3><p>Kelas Aktif</p></div>
                            <div class="icon-wrap"><i class="fas fa-door-open"></i></div>
                            <a href="{{ route('gkmp.progresKelas.index') }}" class="stat-footer"><span>Lihat Detail</span><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card card-dashboard">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-layer-group text-primary mr-2"></i>Progres Dokumen Per Sesi</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @for($sesi = 1; $sesi <= 4; $sesi++)
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            @php $sp = $dokumenPerSesi[$sesi]['persentase']; $sc = $sp >= 75 ? '#34a853' : ($sp >= 50 ? '#f09819' : '#ea4335'); @endphp
                                            <div class="sesi-card" style="background: {{ $sp >= 75 ? 'linear-gradient(135deg, #e8f5e9, #c8e6c9)' : ($sp >= 50 ? 'linear-gradient(135deg, #fff8e1, #ffecb3)' : 'linear-gradient(135deg, #fce4ec, #f8bbd0)') }};">
                                                <h5 style="color: {{ $sc }};">Sesi {{ $sesi }}</h5>
                                                <div class="sesi-percent" style="color: {{ $sc }};">{{ $sp }}%</div>
                                                <div class="progress-thin mt-3 mb-2 mx-auto" style="max-width: 80%;">
                                                    <div class="progress-bar {{ $sp >= 75 ? 'bg-success' : ($sp >= 50 ? 'bg-warning' : 'bg-danger') }}" style="width: {{ $sp }}%"></div>
                                                </div>
                                                <div class="sesi-detail cell-secondary">{{ $dokumenPerSesi[$sesi]['terkumpul'] }}/{{ $dokumenPerSesi[$sesi]['total'] }} dokumen</div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5 mb-3">
                        <div class="card card-dashboard h-100">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-chart-bar text-success mr-2"></i>Ringkasan Status</h3>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <div class="percentage-circle mx-auto" style="border: 4px solid #1a73e8;">
                                        <span style="color: #1a73e8;">{{ $persentaseTerkumpul }}%</span>
                                    </div>
                                    <p class="mt-2 mb-0 cell-secondary">Total Progres Dokumen</p>
                                </div>
                                <div class="progress-modern mb-4">
                                    <div class="progress-bar bg-success" style="width: {{ $persentaseTerkumpul }}%"></div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-icon" style="background: #e3f2fd; color: #1a73e8;"><i class="fas fa-file-alt"></i></div>
                                    <div class="summary-text"><strong>{{ $totalDokumenKelas }}</strong><small>Total Dokumen</small></div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-icon" style="background: #e8f5e9; color: #34a853;"><i class="fas fa-check-circle"></i></div>
                                    <div class="summary-text"><strong>{{ $dokumenTerkumpul }}</strong><small>Terkumpul</small></div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-icon" style="background: #fce4ec; color: #ea4335;"><i class="fas fa-times-circle"></i></div>
                                    <div class="summary-text"><strong>{{ $totalDokumenKelas - $dokumenTerkumpul }}</strong><small>Belum Terkumpul</small></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7 mb-3">
                        <div class="card card-dashboard h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title"><i class="fas fa-list text-primary mr-2"></i>Kelas Terbaru</h3>
                                <a href="{{ route('gkmp.progresKelas.index') }}" class="btn-dashboard btn-dashboard-outline btn-dashboard-sm">
                                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table-dashboard mb-0">
                                        <thead>
                                            <tr>
                                                <th>Kelas</th>
                                                <th>Mata Kuliah</th>
                                                <th>Dosen</th>
                                                <th class="text-center" width="100">Progres</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($kelasList->take(6) as $kelas)
                                                <tr>
                                                    <td class="cell-primary">{{ $kelas['nama'] }}</td>
                                                    <td>{{ $kelas['matkul'] }}</td>
                                                    <td class="cell-secondary">{{ $kelas['dosen'] }}</td>
                                                    <td class="text-center">
                                                        <span class="badge-dashboard {{ $kelas['persentase'] >= 75 ? 'badge-dashboard-success' : ($kelas['persentase'] >= 50 ? 'badge-dashboard-warning' : 'badge-dashboard-danger') }}">
                                                            {{ $kelas['persentase'] }}%
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="empty-state">
                                                            <i class="fas fa-inbox d-block"></i>
                                                            <p>Belum ada kelas</p>
                                                        </div>
                                                    </td>
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

            {{-- ==========================================
                 DOSEN DASHBOARD
                 ========================================== --}}
            @if($user->hasRole('dosen'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card card-dashboard welcome-banner" style="background: linear-gradient(135deg, #0c3366 0%, #1a5276 50%, #2471a3 100%);">
                            <div class="card-body py-4 px-5 d-flex justify-content-between align-items-center">
                                <div>
                                    <h4>Selamat Datang, {{ $user->name }}</h4>
                                    <p>Dosen &bull; TA <strong>{{ $activeTa->tahun_ajaran ?? '-' }}</strong></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="dashboard-stat stat-blue">
                            <div class="inner"><h3>{{ $totalKelas }}</h3><p>Kelas Diampu</p></div>
                            <div class="icon-wrap"><i class="fas fa-door-open"></i></div>
                            <a href="{{ route('dosen.kelasDiampu.index') }}" class="stat-footer"><span>Lihat Detail</span><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="dashboard-stat stat-green">
                            <div class="inner"><h3>{{ $persentaseTerkumpul }}%</h3><p>Dokumen Terkumpul</p></div>
                            <div class="icon-wrap"><i class="fas fa-file-upload"></i></div>
                            <a href="{{ route('dosen.kelasDiampu.index') }}" class="stat-footer"><span>Lihat Detail</span><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="dashboard-stat stat-red">
                            <div class="inner"><h3>{{ $dokumenPending }}</h3><p>Perlu Revisi</p></div>
                            <div class="icon-wrap"><i class="fas fa-exclamation-triangle"></i></div>
                            <a href="{{ route('dosen.kelasDiampu.index') }}" class="stat-footer"><span>Lihat Detail</span><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-lg-6 mb-3">
                        <div class="card card-dashboard h-100">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-file-alt text-primary mr-2"></i>Status Pengumpulan</h3>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    @php $dpColor = $persentaseTerkumpul >= 75 ? '#34a853' : ($persentaseTerkumpul >= 50 ? '#fbbc04' : '#ea4335'); @endphp
                                    <div class="percentage-circle mx-auto" style="border: 4px solid {{ $dpColor }};">
                                        <span style="color: {{ $dpColor }};">{{ $persentaseTerkumpul }}%</span>
                                    </div>
                                    <p class="mt-2 mb-0 cell-secondary">Tingkat Pengumpulan</p>
                                </div>
                                <div class="progress-modern mb-4">
                                    <div class="progress-bar bg-success" style="width: {{ $persentaseTerkumpul }}%"></div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-4">
                                        <div class="stat-box" style="background: #e3f2fd;">
                                            <h4 style="color: #1a73e8;">{{ $totalDokumen }}</h4>
                                            <small class="cell-secondary">Total</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-box" style="background: #e8f5e9;">
                                            <h4 style="color: #34a853;">{{ $dokumenTerkumpul }}</h4>
                                            <small class="cell-secondary">Terkumpul</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-box" style="background: #fce4ec;">
                                            <h4 style="color: #ea4335;">{{ $dokumenPending }}</h4>
                                            <small class="cell-secondary">Revisi</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <div class="card card-dashboard h-100">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-bolt text-warning mr-2"></i>Akses Cepat</h3>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('dosen.kelasDiampu.index') }}" class="quick-link">
                                    <div class="ql-icon" style="background: #e3f2fd; color: #1a73e8;"><i class="fas fa-door-open"></i></div>
                                    <div class="ql-text">
                                        <strong>Kelas Diampu</strong>
                                        <small>Lihat kelas dan status dokumen</small>
                                    </div>
                                </a>
                                <a href="{{ route('dosen.riwayatDokumen.index') }}" class="quick-link">
                                    <div class="ql-icon" style="background: #e8f5e9; color: #34a853;"><i class="fas fa-history"></i></div>
                                    <div class="ql-text">
                                        <strong>Riwayat Dokumen</strong>
                                        <small>Lihat riwayat pengumpulan</small>
                                    </div>
                                </a>
                                <a href="{{ route('profile.edit') }}" class="quick-link">
                                    <div class="ql-icon" style="background: #fff8e1; color: #f09819;"><i class="fas fa-user-cog"></i></div>
                                    <div class="ql-text">
                                        <strong>Profil Saya</strong>
                                        <small>Kelola informasi profil</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @if($kelasList->count() > 0)
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-dashboard">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title"><i class="fas fa-list text-primary mr-2"></i>Kelas Diampu</h3>
                                    <div class="d-flex align-items-center">
                                        <span class="badge-dashboard badge-dashboard-primary mr-2">{{ $activeTa->tahun_ajaran ?? '-' }}</span>
                                        <a href="{{ route('dosen.kelasDiampu.index') }}" class="btn-dashboard btn-dashboard-outline btn-dashboard-sm">
                                            Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table-dashboard mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="60">No</th>
                                                    <th>Kelas</th>
                                                    <th>Mata Kuliah</th>
                                                    <th class="text-center" width="90">Terkumpul</th>
                                                    <th class="text-center" width="90">Revisi</th>
                                                    <th width="220">Progres</th>
                                                    <th class="text-center" width="70">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($kelasList as $index => $kelas)
                                                    <tr>
                                                        <td class="text-center"><span class="row-num">{{ $index + 1 }}</span></td>
                                                        <td class="cell-primary">{{ $kelas['nama'] }}</td>
                                                        <td>{{ $kelas['matkul'] }}</td>
                                                        <td class="text-center"><span class="badge-dashboard badge-dashboard-success">{{ $kelas['terkumpul'] }}</span></td>
                                                        <td class="text-center"><span class="badge-dashboard badge-dashboard-danger">{{ $kelas['pending'] }}</span></td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="progress-thin flex-grow-1 mr-3">
                                                                    <div class="progress-bar {{ $kelas['persentase'] >= 75 ? 'bg-success' : ($kelas['persentase'] >= 50 ? 'bg-warning' : 'bg-danger') }}" style="width: {{ $kelas['persentase'] }}%"></div>
                                                                </div>
                                                                <span class="font-weight-bold" style="min-width: 45px; text-align: right; color: {{ $kelas['persentase'] >= 75 ? '#34a853' : ($kelas['persentase'] >= 50 ? '#f09819' : '#ea4335') }};">
                                                                    {{ $kelas['persentase'] }}%
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ route('dosen.kelasDiampu.show', $kelas['id']) }}" class="btn-dashboard btn-dashboard-icon btn-dashboard-primary" title="Lihat Detail">
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
                    </div>
                @endif
            @endif

        </div>
    </section>
@endsection

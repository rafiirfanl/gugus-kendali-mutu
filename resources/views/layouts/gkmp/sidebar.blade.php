<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4" style="background-color: #0c3366;">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-center border-bottom" style="background-color: #0a2e57;">
        {{-- <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-bold text-white">{{ strtoupper(config('app.name')) }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel my-3 d-flex border-bottom pb-3">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block text-white">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                {{-- DASHBOARD --}}
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @can('view:master-data')
                    {{-- MASTER DATA --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Master Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            {{-- USER MANAGEMENT --}}
                            @can('view:user')
                                <li class="nav-item">
                                    <a href="{{ route('admin.user.index') }}" class="nav-link text-white">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>
                                            Manajemen User
                                        </p>
                                    </a>
                                </li>
                            @endcan

                            {{-- TAHUN AJARAN --}}
                            @can('view:tahun-ajaran')
                                <li class="nav-item">
                                    <a href="{{ route('admin.tahunAjaran.index') }}" class="nav-link text-white">
                                        <i class="nav-icon fas fa-calendar"></i>
                                        <p>
                                            Manajemen Tahun Ajaran
                                        </p>
                                    </a>
                                </li>
                            @endcan

                            {{-- PRODI --}}
                            @can('view:prodi')
                                <li class="nav-item">
                                    <a href="{{ route('admin.prodi.index') }}" class="nav-link text-white">
                                        <i class="nav-icon fas fa-university"></i>
                                        <p>
                                            Manajemen Prodi
                                        </p>
                                    </a>
                                </li>
                            @endcan

                            {{-- DOKUMEN PERKULIAHAN --}}
                            @can('view:dokumen-perkuliahan')
                                <li class="nav-item">
                                    <a href="{{ route('admin.dokumenPerkuliahan.index') }}" class="nav-link text-white">
                                        <i class="nav-icon fas fa-file-alt"></i>
                                        <p>
                                            Manajemen Dokumen Perkuliahan
                                        </p>
                                    </a>
                                </li>
                            @endcan


                            {{-- MATKUL --}}
                            @can('view:matkul')
                                <li class="nav-item">
                                    <a href="{{ route('admin.matkul.index') }}" class="nav-link text-white">
                                        <i class="nav-icon fas fa-book"></i>
                                        <p>
                                            Manajemen Mata Kuliah
                                        </p>
                                    </a>
                                </li>
                            @endcan

                            {{-- ROLE --}}
                            @can('view:role')
                                <li class="nav-item">
                                    <a href="{{ route('admin.role.index') }}" class="nav-link text-white">
                                        <i class="nav-icon fas fa-key"></i>
                                        <p>
                                            Manajemen Role
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                {{-- ASSIGNMENT DOSEN --}}
                @can('view:assignment-dosen')
                    <li class="nav-item">
                        <a href="{{ route('admin.assignmentDosen.stepOne') }}" class="nav-link text-white">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>Assignment Dosen</p>
                        </a>
                    </li>
                @endcan

                {{-- DATA TEMUAN & TINDAK LANJUT --}}
                @can('view:kriteria')
                    <li class="nav-item">
                        <a href="{{ route('admin.temuan.index') }}" class="nav-link text-white">
                            <i class="nav-icon fas fa-folder-open"></i>
                            <p>Data Temuan & Tindak Lanjut</p>
                        </a>
                    </li>
                @endcan

                {{-- GKMP --}}
                {{-- PROGRES KELAS --}}
                @can('view:progres-kelas')
                    <li class="nav-item">
                        <a href="{{ route('gkmp.progresKelas.index') }}" class="nav-link text-white">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>Progres Kelas</p>
                        </a>
                    </li>
                @endcan


                {{-- KELAS --}}
                @can('view:kelas')
                    <li class="nav-item">
                        <a href="{{ route('admin.kelas.index') }}" class="nav-link text-white">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Manajemen Kelas
                            </p>
                        </a>
                    </li>
                @endcan

                {{-- DOSEN -- --}}
                {{-- KELAS DIAMPU --}}
                @can('view:kelas-diampu')
                    <li class="nav-item">
                        <a href="{{ route('dosen.kelasDiampu.index') }}" class="nav-link text-white">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Kelas Diampu
                            </p>
                        </a>
                    </li>
                @endcan

                {{-- RIWAYAT DOKUMEN --}}
                @can('view:riwayat-dokumen')
                    <li class="nav-item">
                        <a href="{{ route('dosen.riwayatDokumen.index') }}" class="nav-link text-white">
                            <i class="nav-icon fas fa-history"></i>
                            <p>
                                Riwayat Dokumen
                            </p>
                        </a>
                    </li>
                @endcan

                {{-- LOGOUT --}}
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                        @csrf
                    </form>
                    <a href="#" class="nav-link text-white @yield('')"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

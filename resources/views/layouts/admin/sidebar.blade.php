{{-- SIDEBAR STYLES --}}
<style>
    .app-sidebar {
        width: 260px;
        min-height: 100vh;
        background: #0c3366;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1038;
        display: flex;
        flex-direction: column;
    }

    .sidebar-brand {
        padding: 18px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sidebar-brand .brand-icon {
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 800;
        font-size: 13px;
        flex-shrink: 0;
    }

    .sidebar-brand .brand-text {
        color: #f1f5f9;
        font-weight: 700;
        font-size: 0.9rem;
        white-space: nowrap;
    }

    .sidebar-user {
        padding: 14px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        gap: 10px;
        transition: background 0.15s;
        cursor: pointer;
    }

    .sidebar-user:hover {
        background: rgba(255, 255, 255, 0.08);
    }

    .sidebar-user .user-avatar {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #cbd5e1;
        font-weight: 700;
        font-size: 0.8rem;
        flex-shrink: 0;
    }

    .sidebar-user .user-name {
        color: #e2e8f0;
        font-weight: 600;
        font-size: 0.84rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sidebar-user .user-role {
        color: rgba(255, 255, 255, 0.45);
        font-size: 0.7rem;
        font-weight: 500;
    }

    .sidebar-menu {
        flex: 1;
        overflow-y: auto;
        padding: 10px 0;
        scrollbar-width: thin;
        scrollbar-color: rgba(255, 255, 255, 0.1) transparent;
    }

    .sidebar-section {
        padding: 0 12px;
        margin-bottom: 6px;
    }

    .sidebar-section-title {
        color: rgba(255, 255, 255, 0.35);
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 10px 10px 6px;
    }

    .sidebar-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-nav-item {
        margin-bottom: 1px;
    }

    .sidebar-nav-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 12px;
        color: rgba(255, 255, 255, 0.65);
        text-decoration: none;
        border-radius: 6px;
        font-size: 0.84rem;
        font-weight: 500;
        transition: background 0.15s, color 0.15s;
        white-space: nowrap;
    }

    .sidebar-nav-link:hover {
        background: rgba(255, 255, 255, 0.08);
        color: #ffffff;
    }

    .sidebar-nav-link.active {
        background: rgba(255, 255, 255, 0.15);
        color: #ffffff;
    }

    .sidebar-nav-link .nav-icon {
        width: 18px;
        text-align: center;
        font-size: 0.85rem;
        flex-shrink: 0;
    }

    .sidebar-nav-link .nav-text {
        flex: 1;
    }

    .sidebar-treeview {
        list-style: none;
        padding: 0 0 0 18px;
        margin: 0;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.25s ease;
    }

    .sidebar-treeview.show {
        max-height: 600px;
    }

    .sidebar-treeview .sidebar-nav-link {
        padding: 7px 12px;
        font-size: 0.8rem;
    }

    .sidebar-treeview .sidebar-nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 3px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.25);
    }

    .sidebar-treeview .sidebar-nav-link.active::before {
        background: #ffffff;
    }

    .sidebar-footer {
        padding: 10px 12px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-footer .sidebar-nav-link:hover {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
    }

    @media (max-width: 991.98px) {
        .app-sidebar {
            transform: translateX(-100%);
        }

        .app-sidebar.mobile-open {
            transform: translateX(0);
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1037;
        }

        .sidebar-overlay.show {
            display: block;
        }
    }
</style>

<aside class="app-sidebar" id="appSidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">GKM</div>
        <span class="brand-text">{{ strtoupper(config('app.name')) }}</span>
    </div>

    <a href="{{ route('profile.edit') }}" class="sidebar-user" style="text-decoration:none;color:inherit;">
        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
        <div>
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role">
                @if(Auth::user()->hasRole('gkmf')) GKM Fakultas
                @elseif(Auth::user()->hasRole('gkmp')) GKM Prodi
                @elseif(Auth::user()->hasRole('kaprodi')) Kaprodi
                @elseif(Auth::user()->hasRole('dosen')) Dosen
                @else {{ Auth::user()->getRoleNames()->first() }}
                @endif
            </div>
        </div>
    </a>

    <div class="sidebar-menu">
        <div class="sidebar-section">
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-nav-link {{ request()->routeIs('admin.dashboard', 'dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large nav-icon"></i>
                <span class="nav-text">Dashboard</span>
            </a>
        </div>

        @canany(['view:user', 'view:tahun-ajaran', 'view:prodi', 'view:dokumen-perkuliahan', 'view:matkul', 'view:role', 'view:kelas'])
            <div class="sidebar-section">
                <div class="sidebar-section-title">Master Data</div>
                <ul class="sidebar-nav">
                    @can('view:user')
                        <li class="sidebar-nav-item">
                            <a href="{{ route('admin.user.index') }}"
                               class="sidebar-nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                                <i class="fas fa-users nav-icon"></i>
                                <span class="nav-text">Manajemen User</span>
                            </a>
                        </li>
                    @endcan
                    @can('view:tahun-ajaran')
                        <li class="sidebar-nav-item">
                            <a href="{{ route('admin.tahunAjaran.index') }}"
                               class="sidebar-nav-link {{ request()->routeIs('admin.tahunAjaran.*') ? 'active' : '' }}">
                                <i class="fas fa-calendar-alt nav-icon"></i>
                                <span class="nav-text">Tahun Ajaran</span>
                            </a>
                        </li>
                    @endcan
                    @can('view:prodi')
                        <li class="sidebar-nav-item">
                            <a href="{{ route('admin.prodi.index') }}"
                               class="sidebar-nav-link {{ request()->routeIs('admin.prodi.*') ? 'active' : '' }}">
                                <i class="fas fa-university nav-icon"></i>
                                <span class="nav-text">Program Studi</span>
                            </a>
                        </li>
                    @endcan
                    @can('view:matkul')
                        <li class="sidebar-nav-item">
                            <a href="{{ route('admin.matkul.index') }}"
                               class="sidebar-nav-link {{ request()->routeIs('admin.matkul.*') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <span class="nav-text">Mata Kuliah</span>
                            </a>
                        </li>
                    @endcan
                    @can('view:kelas')
                        <li class="sidebar-nav-item">
                            <a href="{{ route('admin.kelas.index') }}"
                               class="sidebar-nav-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
                                <i class="fas fa-door-open nav-icon"></i>
                                <span class="nav-text">Kelas</span>
                            </a>
                        </li>
                    @endcan
                    @can('view:dokumen-perkuliahan')
                        <li class="sidebar-nav-item">
                            <a href="{{ route('admin.dokumenPerkuliahan.index') }}"
                               class="sidebar-nav-link {{ request()->routeIs('admin.dokumenPerkuliahan.*') ? 'active' : '' }}">
                                <i class="fas fa-file-alt nav-icon"></i>
                                <span class="nav-text">Dokumen Perkuliahan</span>
                            </a>
                        </li>
                    @endcan
                    @can('view:role')
                        <li class="sidebar-nav-item">
                            <a href="{{ route('admin.role.index') }}"
                               class="sidebar-nav-link {{ request()->routeIs('admin.role.*') ? 'active' : '' }}">
                                <i class="fas fa-shield-alt nav-icon"></i>
                                <span class="nav-text">Role &amp; Permission</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        @endcanany

        @can('view:assignment-dosen')
            <div class="sidebar-section">
                <div class="sidebar-section-title">Assignment</div>
                <ul class="sidebar-nav">
                    <li class="sidebar-nav-item">
                        <a href="{{ route('admin.assignmentDosen.stepOne') }}"
                           class="sidebar-nav-link {{ request()->routeIs('admin.assignmentDosen.*') ? 'active' : '' }}">
                            <i class="fas fa-user-tie nav-icon"></i>
                            <span class="nav-text">Assignment Dosen</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endcan

        @canany(['view:kriteria', 'generate:tindak-lanjut'])
            <div class="sidebar-section">
                <div class="sidebar-section-title">Data Temuan</div>
                <ul class="sidebar-nav">
                    @can('view:kriteria')
                        <li class="sidebar-nav-item">
                            <a href="{{ route('admin.temuan.index') }}"
                               class="sidebar-nav-link {{ request()->routeIs('admin.temuan.*') ? 'active' : '' }}">
                                <i class="fas fa-search nav-icon"></i>
                                <span class="nav-text">Kriteria &amp; Subkriteria</span>
                            </a>
                        </li>
                    @endcan
                    @can('generate:tindak-lanjut')
                        <li class="sidebar-nav-item">
                            <a href="{{ route('admin.tindak-lanjut.index') }}"
                               class="sidebar-nav-link {{ request()->routeIs('admin.tindak-lanjut.*') ? 'active' : '' }}">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <span class="nav-text">Tindak Lanjut</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        @endcanany

        @canany(['view:progres-kelas', 'progres:tindak-lanjut'])
            <div class="sidebar-section">
                <div class="sidebar-section-title">GKM Prodi</div>
                <ul class="sidebar-nav">
                    @can('view:progres-kelas')
                        <li class="sidebar-nav-item">
                            <a href="{{ route('gkmp.progresKelas.index') }}"
                               class="sidebar-nav-link {{ request()->routeIs('gkmp.progresKelas.*', 'gkmp.detailKelas.*') ? 'active' : '' }}">
                                <i class="fas fa-chart-bar nav-icon"></i>
                                <span class="nav-text">Progres Kelas</span>
                            </a>
                        </li>
                    @endcan
                    @can('progres:tindak-lanjut')
                        <li class="sidebar-nav-item">
                            <a href="{{ route('gkmp.tindak-lanjut.index') }}"
                               class="sidebar-nav-link {{ request()->routeIs('gkmp.tindak-lanjut.*') ? 'active' : '' }}">
                                <i class="fas fa-tasks nav-icon"></i>
                                <span class="nav-text">Progres Tindak Lanjut</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        @endcanany

        @canany(['view:kelas-diampu', 'view:riwayat-dokumen'])
            <div class="sidebar-section">
                <div class="sidebar-section-title">Dosen</div>
                <ul class="sidebar-nav">
                    @can('view:kelas-diampu')
                        <li class="sidebar-nav-item">
                            <a href="{{ route('dosen.kelasDiampu.index') }}"
                               class="sidebar-nav-link {{ request()->routeIs('dosen.kelasDiampu.*') ? 'active' : '' }}">
                                <i class="fas fa-chalkboard nav-icon"></i>
                                <span class="nav-text">Kelas Diampu</span>
                            </a>
                        </li>
                    @endcan
                    @can('view:riwayat-dokumen')
                        <li class="sidebar-nav-item">
                            <a href="{{ route('dosen.riwayatDokumen.index') }}"
                               class="sidebar-nav-link {{ request()->routeIs('dosen.riwayatDokumen.*') ? 'active' : '' }}">
                                <i class="fas fa-history nav-icon"></i>
                                <span class="nav-text">Riwayat Dokumen</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        @endcanany
    </div>

    <div class="sidebar-footer">
        <a href="{{ route('profile.edit') }}" class="sidebar-nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <i class="fas fa-user-cog nav-icon"></i>
            <span class="nav-text">Profile</span>
        </a>
        <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST" hidden>@csrf</form>
        <a href="#" class="sidebar-nav-link"
           onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
            <i class="fas fa-sign-out-alt nav-icon"></i>
            <span class="nav-text">Logout</span>
        </a>
    </div>
</aside>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<script>
    function toggleSidebar() {
        document.getElementById('appSidebar').classList.toggle('mobile-open');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }
</script>

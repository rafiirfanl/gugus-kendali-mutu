<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      {{-- <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">{{ strtoupper(config('app.name')) }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {{-- <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image"> --}}
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        {{-- DASHBOARD --}}
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

        {{-- USER MANAGEMENT --}}
          <li class="nav-item">
            <a href="{{ route('admin.user.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manajemen User
              </p>
            </a>
          </li>

        {{-- TAHUN AJARAN --}}
          <li class="nav-item">
            <a href="{{ route('admin.tahunAjaran.index') }}" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Manajemen Tahun Ajaran
              </p>
            </a>
          </li>

        {{-- PRODI --}}
          <li class="nav-item">
            <a href="{{ route('admin.prodi.index') }}" class="nav-link">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Manajemen Prodi
              </p>
            </a>
          </li>

        {{-- MATKUL --}}
          <li class="nav-item">
            <a href="{{ route('admin.matkul.index') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Manajemen Mata Kuliah
              </p>
            </a>
          </li>

        {{-- KELAS --}}
          <li class="nav-item">
            <a href="{{ route('admin.kelas.index') }}" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Manajemen Kelas
              </p>
            </a>
          </li>

        {{-- ROLE --}}
          <li class="nav-item">
            <a href="{{ route('admin.role.index') }}" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Manajemen Role
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
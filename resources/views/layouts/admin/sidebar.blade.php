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
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        {{-- DASHBOARD --}}
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

        {{-- USER MANAGEMENT --}}
          <li class="nav-item">
            <a href="{{ route('admin.user.index') }}" class="nav-link text-white">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manajemen User
              </p>
            </a>
          </li>

        {{-- TAHUN AJARAN --}}
          <li class="nav-item">
            <a href="{{ route('admin.tahunAjaran.index') }}" class="nav-link text-white">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Manajemen Tahun Ajaran
              </p>
            </a>
          </li>

        {{-- PRODI --}}
          <li class="nav-item">
            <a href="{{ route('admin.prodi.index') }}" class="nav-link text-white">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Manajemen Prodi
              </p>
            </a>
          </li>

        {{-- MATKUL --}}
          <li class="nav-item">
            <a href="{{ route('admin.matkul.index') }}" class="nav-link text-white">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Manajemen Mata Kuliah
              </p>
            </a>
          </li>

        {{-- KELAS --}}
          <li class="nav-item">
            <a href="{{ route('admin.kelas.index') }}" class="nav-link text-white">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Manajemen Kelas
              </p>
            </a>
          </li>

        {{-- ROLE --}}
          <li class="nav-item">
            <a href="{{ route('admin.role.index') }}" class="nav-link text-white">
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
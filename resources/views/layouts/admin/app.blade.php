<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    {{-- <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"> --}}
    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />

    <!-- Bootstrap Datepicker -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" />

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.2.7/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* ============================================
           SHARED CRUD STYLES
           ============================================ */
        :root {
            --crud-primary: #0c3366;
            --crud-primary-light: #1a5276;
            --crud-accent: #1a73e8;
            --crud-success: #34a853;
            --crud-warning: #fbbc04;
            --crud-danger: #ea4335;
            --crud-text: #1a1a2e;
            --crud-muted: #6c757d;
            --crud-border: #e9ecef;
            --crud-bg: #f8f9fc;
            --crud-radius: 10px;
            --crud-shadow: 0 2px 8px rgba(0,0,0,0.06);
            --crud-shadow-md: 0 4px 12px rgba(0,0,0,0.08);
        }

        /* Card Wrapper */
        .crud-card {
            background: white;
            border: none;
            border-radius: var(--crud-radius);
            box-shadow: var(--crud-shadow);
            overflow: hidden;
            margin-bottom: 20px;
        }
        .crud-card .crud-card-header {
            padding: 18px 24px;
            border-bottom: 2px solid var(--crud-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }
        .crud-card .crud-card-header h5 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--crud-text);
        }
        .crud-card .crud-card-header h5 i {
            margin-right: 8px;
        }
        .crud-card .crud-card-body {
            padding: 0;
        }

        /* Table */
        .crud-table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            margin: 0;
        }
        .crud-table thead th {
            background: var(--crud-primary);
            color: white;
            font-weight: 600;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 14px 18px;
            border: none;
            white-space: nowrap;
        }
        .crud-table thead th:first-child { border-radius: 0; }
        .crud-table thead th:last-child { border-radius: 0; }
        .crud-table tbody td {
            padding: 14px 18px;
            vertical-align: middle;
            border-bottom: 1px solid var(--crud-border);
            font-size: 0.88rem;
            color: var(--crud-text);
            transition: background 0.15s;
        }
        .crud-table tbody tr {
            transition: all 0.15s;
        }
        .crud-table tbody tr:hover {
            background-color: #f0f4ff;
        }
        .crud-table tbody tr:last-child td {
            border-bottom: none;
        }
        .crud-table .row-num {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--crud-border);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            color: var(--crud-muted);
        }
        .crud-table .cell-bold {
            font-weight: 600;
            color: var(--crud-text);
        }
        .crud-table .cell-muted {
            color: var(--crud-muted);
            font-size: 0.82rem;
        }

        /* Buttons */
        .btn-crud {
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.82rem;
            padding: 8px 18px;
            letter-spacing: 0.3px;
            transition: all 0.2s;
            border: none;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-crud:hover {
            box-shadow: 0 4px 10px rgba(0,0,0,0.12);
            transform: translateY(-1px);
        }
        .btn-crud-primary {
            background: var(--crud-accent);
            color: white;
        }
        .btn-crud-primary:hover {
            background: #1557b0;
            color: white;
        }
        .btn-crud-success {
            background: var(--crud-success);
            color: white;
        }
        .btn-crud-success:hover {
            background: #2d9249;
            color: white;
        }
        .btn-crud-warning {
            background: #f59e0b;
            color: white;
        }
        .btn-crud-warning:hover {
            background: #d97706;
            color: white;
        }
        .btn-crud-danger {
            background: var(--crud-danger);
            color: white;
        }
        .btn-crud-danger:hover {
            background: #c62828;
            color: white;
        }
        .btn-crud-secondary {
            background: #6c757d;
            color: white;
        }
        .btn-crud-secondary:hover {
            background: #5a6268;
            color: white;
        }
        .btn-crud-outline {
            background: transparent;
            border: 1.5px solid var(--crud-accent);
            color: var(--crud-accent);
            box-shadow: none;
        }
        .btn-crud-outline:hover {
            background: var(--crud-accent);
            color: white;
        }
        .btn-crud-sm {
            padding: 6px 12px;
            font-size: 0.78rem;
            border-radius: 6px;
        }
        .btn-crud-icon {
            width: 34px;
            height: 34px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 0.85rem;
        }

        /* Badges */
        .badge-crud {
            display: inline-flex;
            align-items: center;
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        .badge-crud-success {
            background: #e8f5e9;
            color: #1b7a35;
        }
        .badge-crud-danger {
            background: #fce4ec;
            color: #c62828;
        }
        .badge-crud-warning {
            background: #fff8e1;
            color: #e65100;
        }
        .badge-crud-info {
            background: #e3f2fd;
            color: #1565c0;
        }
        .badge-crud-primary {
            background: #e8eaf6;
            color: #283593;
        }
        .badge-crud-secondary {
            background: #e9ecef;
            color: #495057;
        }

        /* Modal */
        .modal-crud .modal-content {
            border: none;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }
        .modal-crud .modal-header {
            background: linear-gradient(135deg, var(--crud-primary) 0%, var(--crud-primary-light) 100%);
            color: white;
            border: none;
            padding: 18px 24px;
        }
        .modal-crud .modal-header .modal-title {
            font-weight: 700;
            font-size: 1.05rem;
            color: white;
        }
        .modal-crud .modal-header .close {
            color: white;
            opacity: 0.8;
            text-shadow: none;
        }
        .modal-crud .modal-header .close:hover {
            opacity: 1;
        }
        .modal-crud .modal-body {
            padding: 24px;
            text-align: left;
        }
        .modal-crud .modal-dialog {
            align-items: flex-start;
            padding-top: 60px;
        }
        .modal-crud .modal-footer {
            border-top: 2px solid var(--crud-border);
            padding: 16px 24px;
        }

        /* Form Fields */
        .form-crud .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--crud-text);
            margin-bottom: 6px;
            text-align: left;
            display: block;
        }
        .form-crud .form-label .text-danger {
            margin-left: 2px;
        }
        .form-crud .form-control,
        .form-crud .form-select {
            border: 1.5px solid var(--crud-border);
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.88rem;
            transition: all 0.2s;
            background: white;
        }
        .form-crud .form-control:focus,
        .form-crud .form-select:focus {
            border-color: var(--crud-accent);
            box-shadow: 0 0 0 3px rgba(26,115,232,0.12);
        }
        .form-crud .form-control::placeholder {
            color: #adb5bd;
        }
        .form-crud .invalid-feedback {
            font-size: 0.78rem;
            margin-top: 4px;
        }

        /* Delete Modal */
        .modal-crud-delete .modal-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #fce4ec;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }
        .modal-crud-delete .modal-icon i {
            font-size: 1.8rem;
            color: var(--crud-danger);
        }
        .modal-crud-delete .modal-title-text {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--crud-text);
            margin-bottom: 8px;
        }
        .modal-crud-delete .modal-desc {
            color: var(--crud-muted);
            font-size: 0.9rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: var(--crud-muted);
        }
        .empty-state i {
            font-size: 3.5rem;
            margin-bottom: 14px;
            opacity: 0.3;
        }
        .empty-state p {
            margin: 0;
            font-size: 0.92rem;
        }

        /* Responsive sidebar */
        @media (max-width: 991.98px) {
            .main-header.navbar {
                margin-left: 0 !important;
            }
            .content-wrapper {
                margin-left: 0 !important;
            }
            .main-footer {
                margin-left: 0 !important;
            }
        }

        /* Main content area */
        .content-wrapper > .content {
            padding: 0 28px 28px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed" style="background: #f3f4f6;">
    <div class="wrapper" style="margin-left: 0;">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light"
             style="margin-left: 260px; border-bottom: 1px solid #e5e7eb; background: white;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button"
                       onclick="event.preventDefault(); toggleSidebar();"
                       style="color: #64748b;">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <span class="nav-link" style="color: #6b7280; font-size: 0.83rem;">
                        {{ now()->translatedFormat('l, d M Y') }}
                    </span>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        @include('layouts.admin.sidebar')
        @if ($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: `{!! implode('<br>', $errors->all()) !!}`,
                        confirmButtonColor: '#d33',
                    });
                });
            </script>
        @endif

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Successfully!',
                        text: '{{ session('success') }}',
                        confirmButtonColor: '#28a745',
                    });
                });
            </script>
        @endif


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-left: 260px; background: #f1f5f9; border: none;">
            <!-- Content Header (Page header) -->
            <div class="content-header" style="background: transparent; border: none; padding: 20px 28px 0;">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0" style="font-size: 1.4rem; font-weight: 700; color: #1e293b;">@yield('title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right" style="background: transparent; padding: 0; margin: 0;">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: #3b82f6; text-decoration: none;">Home</a></li>
                                <li class="breadcrumb-item active" style="color: #64748b;">@yield('title')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer" style="margin-left: 260px; background: white; border-top: 1px solid #e2e8f0; padding: 16px 24px;">
            <strong style="color: #64748b; font-size: 0.82rem;">Copyright &copy; {{ date('Y') }} <a href="#" style="color: #3b82f6; text-decoration: none;">{{ strtoupper(config('app.name')) }}</a>.</strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    {{-- <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    {{-- Bootstrap 5 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">    </script>
    <!-- ChartJS  -->
    <script src="{{ asset('plugins/chart.js') }}/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    {{-- <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> --}}
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Bootstrap Datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js">
    </script>

    <!-- Flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @yield('script')
</body>

</html>

@extends('layouts.admin.app')
@section('title', 'Assignment Tindak Lanjut')

@section('content')
    <div class="container-fluid">
        {{-- ALERT SUCCESS --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- BUTTON GENERATE --}}
        <form action="{{ route('admin.tindak-lanjut.generate') }}" method="POST"
            onsubmit="return confirm('Generate tindak lanjut untuk semua prodi?')">
            @csrf
            <button type="submit" class="btn btn-primary mb-3">
                Generate Tindak Lanjut <i class="fa fa-plus ms-1"></i>
            </button>
        </form>

        {{-- CARD --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0">Progres Tindak Lanjut per Prodi</h3>
            </div>

            <div class="card-body">

                {{-- JIKA BELUM ADA DATA --}}
                @if ($data->isEmpty())
                    <div class="alert alert-warning text-center mb-0">
                        Tindak lanjut belum digenerate.<br>
                        Silakan klik <strong>Generate Tindak Lanjut</strong>.
                    </div>
                @else
                    {{-- TABLE --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-secondary">
                                <tr class="text-center">
                                    <th width="5%">No</th>
                                    <th>Prodi</th>
                                    <th width="15%">Selesai</th>
                                    <th width="15%">Progres</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $row['prodi']->nama_prodi }} ({{ $row['prodi']->kode_prodi }})</td>
                                        <td class="text-center">
                                            {{ $row['selesai'] }} / {{ $row['total'] }}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary">
                                                {{ $row['persen'] }}%
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

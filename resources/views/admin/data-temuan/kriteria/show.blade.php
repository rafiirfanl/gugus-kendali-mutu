@extends('layouts.admin.app')
@section('title', 'Detail Kriteria')

@section('content')
    <section class="content">
        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-folder-open"></i> Kriteria: {{ $kriteria->nama }}</h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.temuan.index') }}" class="btn-crud btn-crud-secondary btn-crud-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <a href="{{ route('admin.temuan.sub.create', $kriteria->id) }}" class="btn-crud btn-crud-primary btn-crud-sm">
                        <i class="fas fa-plus mr-1"></i> Tambah Subkriteria
                    </a>
                </div>
            </div>
            <div class="crud-card-body">
                @if ($kriteria->deskripsi)
                    <div class="p-4" style="border-bottom:1px solid #e9ecef;">
                        <p class="mb-0" style="color:#6c757d;font-size:0.9rem;">{{ $kriteria->deskripsi }}</p>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="crud-table">
                        <thead>
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th>Kode</th>
                                <th>Hasil Temuan</th>
                                <th class="text-center" width="180">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kriteria->subkriterias as $sub)
                                <tr>
                                    <td class="text-center"><span class="row-num">{{ $loop->iteration }}</span></td>
                                    <td><span class="badge-crud badge-crud-primary">{{ $sub->kode }}</span></td>
                                    <td>
                                        @if ($sub->hasilTemuans->count() == 0)
                                            <span class="badge-crud badge-crud-warning">Belum ada</span>
                                        @else
                                            <ul class="mb-0 pl-3">
                                                @foreach ($sub->hasilTemuans as $hasil)
                                                    <li style="font-size:0.88rem;">{{ $hasil->hasil_temuan }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('admin.temuan.sub.edit', [$kriteria->id, $sub->id]) }}" class="btn-crud btn-crud-warning btn-crud-sm">
                                                <i class="fas fa-edit"></i> <span class="d-none d-sm-inline">Edit</span>
                                            </a>
                                            <form action="{{ route('admin.temuan.sub.destroy', [$kriteria->id, $sub->id]) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button class="btn-crud btn-crud-danger btn-crud-sm"><i class="fas fa-trash"></i> <span class="d-none d-sm-inline">Hapus</span></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="empty-state">
                                            <i class="fas fa-sitemap d-block"></i>
                                            <p>Belum ada subkriteria</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

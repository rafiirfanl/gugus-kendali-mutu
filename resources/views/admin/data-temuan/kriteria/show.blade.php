@extends('layouts.admin.app')
@section('title', 'Detail Kriteria')

@section('content')
    <div class="container">

        <h3 class="mb-3">Kriteria: {{ $kriteria->nama }}</h3>

        <a href="{{ route('admin.temuan.sub.create', $kriteria->id) }}" class="btn btn-primary mb-3">
            Tambah Subkriteria
        </a>

        <div class="card">
            <div class="card-header bg-info text-white">
                Daftar Subkriteria
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Hasil Temuan</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($kriteria->subkriterias as $sub)
                        <tr>
                            <td>{{ $sub->kode }}</td>

                            <td>
                                @if ($sub->hasilTemuans->count() == 0)
                                    <span class="text-muted">Belum ada hasil temuan</span>
                                @else
                                    <ul class="mb-0">
                                        @foreach ($sub->hasilTemuans as $hasil)
                                            <li>{{ $hasil->hasil_temuan }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.temuan.sub.edit', [$kriteria->id, $sub->id]) }}"
                                    class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('admin.temuan.sub.destroy', [$kriteria->id, $sub->id]) }}"
                                    method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada subkriteria.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
@endsection

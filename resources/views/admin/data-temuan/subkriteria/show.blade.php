@extends('layouts.admin.app')

@section('content')
    <div class="container">

        <h4>Subkriteria: {{ $sub->kode }} — {{ $sub->judul }}</h4>
        <p>Kriteria: <strong>{{ $kriteria->judul }}</strong></p>

        <a href="{{ route('admin.temuan.sub.isi.create', [$kriteria->id, $sub->id]) }}" class="btn btn-primary mb-3">
            Tambah Isi Subkriteria
        </a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Isi Subkriteria</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sub->isi as $isi)
                    <tr>
                        <td>{{ $isi->isi }}</td>
                        <td>
                            <a href="{{ route('admin.temuan.sub.isi.edit', [$kriteria->id, $sub->id, $isi->id]) }}"
                                class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.temuan.sub.isi.destroy', [$kriteria->id, $sub->id, $isi->id]) }}"
                                method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">Belum ada isi subkriteria.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
@endsection

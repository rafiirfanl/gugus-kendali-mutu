@extends('layouts.admin.app')
@section('title', 'Tambah Kriteria')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Kriteria</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.temuan.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="nama">Nama Kriteria</label>
                    <input type="text" name="nama" id="nama"
                           class="form-control @error('nama') is-invalid @enderror"
                           placeholder="Masukkan nama kriteria"
                           value="{{ old('nama') }}">

                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.temuan.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

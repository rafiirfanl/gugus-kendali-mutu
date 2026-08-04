@extends('layouts.admin.app')
@section('title', 'Tambah Kriteria')

@section('content')
    <section class="content">
        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-folder-open"></i> Tambah Kriteria</h5>
                <a href="{{ route('admin.temuan.index') }}" class="btn-crud btn-crud-secondary btn-crud-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
            <div class="crud-card-body">
                <form action="{{ route('admin.temuan.store') }}" method="POST">
                    @csrf

                    <div class="p-4">
                        <div class="mb-3">
                            <label class="form-label">Nama Kriteria <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                placeholder="Masukkan nama kriteria" value="{{ old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi kriteria (opsional)">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn-crud btn-crud-primary">
                                <i class="fas fa-save mr-1"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

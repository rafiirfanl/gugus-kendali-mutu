@extends('layouts.admin.app')
@section('title', 'Edit Subkriteria')

@section('content')
    <section class="content">
        <div class="crud-card">
            <div class="crud-card-header">
                <h5><i class="fas fa-folder-open"></i> Edit Subkriteria: <strong>{{ $sub->kode }}</strong></h5>
                <a href="{{ route('admin.temuan.show', $sub->kriteria_id) }}" class="btn-crud btn-crud-secondary btn-crud-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
            <div class="crud-card-body">
                <form action="{{ route('admin.temuan.sub.update', [$sub->kriteria_id, $sub->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kode Subkriteria <span class="text-danger">*</span></label>
                                <input type="text" name="kode" class="form-control" value="{{ $sub->kode }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Judul Subkriteria <span class="text-danger">*</span></label>
                                <input type="text" name="judul" class="form-control" value="{{ old('judul', $sub->judul ?? '') }}" placeholder="Masukkan judul subkriteria" required>
                            </div>
                        </div>

                        <h6 class="mt-3 mb-3" style="font-weight:700;color:#0c3366;">
                            <i class="fas fa-list-ul mr-1"></i> Daftar Hasil Temuan
                        </h6>

                        <div id="container-hasil-temuan">
                            @foreach ($sub->hasilTemuans as $hasil)
                                <div class="row mb-2 hasil-temuan-row align-items-center">
                                    <input type="hidden" name="id_hasil_temuan[]" value="{{ $hasil->id }}">
                                    <div class="col-10">
                                        <input type="text" name="hasil_temuan_existing[]" class="form-control"
                                            value="{{ $hasil->hasil_temuan }}" required>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn-crud btn-crud-danger btn-crud-sm w-100 btn-remove">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn-crud btn-crud-secondary btn-crud-sm mt-2" id="btn-tambah">
                            <i class="fas fa-plus mr-1"></i> Tambah Hasil Temuan
                        </button>

                        <input type="hidden" name="deleted_ids" id="deleted-ids">

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="submit" class="btn-crud btn-crud-primary">
                                <i class="fas fa-save mr-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const container = document.getElementById("container-hasil-temuan");
            const btnTambah = document.getElementById("btn-tambah");
            const deletedIdsInput = document.getElementById("deleted-ids");
            let deletedIds = [];

            btnTambah.addEventListener("click", function() {
                const row = document.createElement("div");
                row.classList.add("row", "mb-2", "hasil-temuan-row", "align-items-center");
                row.innerHTML = `
                    <input type="hidden" name="id_hasil_temuan[]" value="new">
                    <div class="col-10">
                        <input type="text" name="hasil_temuan_existing[]" class="form-control" placeholder="Masukkan hasil temuan baru" required>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn-crud btn-crud-danger btn-crud-sm w-100 btn-remove">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                `;
                container.appendChild(row);
            });

            container.addEventListener("click", function(event) {
                if (event.target.classList.contains("btn-remove")) {
                    const row = event.target.closest(".hasil-temuan-row");
                    const hiddenInput = row.querySelector('input[name="id_hasil_temuan[]"]');

                    if (hiddenInput.value !== "new") {
                        deletedIds.push(hiddenInput.value);
                        deletedIdsInput.value = JSON.stringify(deletedIds);
                    }

                    row.remove();
                }
            });
        });
    </script>
@endsection

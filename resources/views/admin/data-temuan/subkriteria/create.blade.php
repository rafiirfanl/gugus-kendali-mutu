@extends('layouts.admin.app')

@section('content')
    <div class="container">

        <h4>Tambah Subkriteria untuk: <strong>{{ $kriteria->nama }}</strong></h4>
        <hr>

        <form action="{{ route('admin.temuan.sub.store', $kriteria->id) }}" method="POST">
            @csrf

            {{-- INPUT KODE --}}
            <div class="mb-3">
                <label class="form-label">Kode Subkriteria</label>
                <input type="text" name="kode" class="form-control" placeholder="Contoh: A1" required>
            </div>

            <h5 class="mt-4">Daftar Hasil Temuan</h5>

            {{-- Wadah semua baris hasil temuan --}}
            <div id="container-hasil-temuan">

                {{-- Baris Default --}}
                <div class="row mb-2 hasil-temuan-row">
                    <div class="col-10">
                        <input type="text" name="hasil_temuan[]" class="form-control" placeholder="Masukkan hasil temuan"
                            required>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-danger w-100 btn-remove">
                            Hapus
                        </button>
                    </div>
                </div>

            </div>

            {{-- Tombol tambah baris --}}
            <button type="button" class="btn btn-secondary mt-2" id="btn-tambah">
                + Tambah Hasil Temuan
            </button>

            <br><br>

            <button class="btn btn-primary">Simpan</button>

        </form>
    </div>

    {{-- SCRIPT untuk tambah/hapus baris --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const container = document.getElementById("container-hasil-temuan");
            const btnTambah = document.getElementById("btn-tambah");

            btnTambah.addEventListener("click", function() {

                const row = document.createElement("div");
                row.classList.add("row", "mb-2", "hasil-temuan-row");

                row.innerHTML = `
            <div class="col-10">
                <input type="text" name="hasil_temuan[]" class="form-control"
                       placeholder="Masukkan hasil temuan" required>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-danger w-100 btn-remove">
                    Hapus
                </button>
            </div>
        `;

                container.appendChild(row);
            });

            container.addEventListener("click", function(event) {
                if (event.target.classList.contains("btn-remove")) {
                    event.target.closest(".hasil-temuan-row").remove();
                }
            });

        });
    </script>
@endsection

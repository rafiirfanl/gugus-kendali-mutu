@extends('layouts.admin.app')

@section('content')
    <div class="container">

        <h4>Edit Subkriteria: <strong>{{ $sub->kode }}</strong></h4>
        <hr>

        <form action="{{ route('admin.temuan.sub.update', [$sub->kriteria_id, $sub->id]) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- INPUT KODE --}}
            <div class="mb-3">
                <label class="form-label">Kode Subkriteria</label>
                <input type="text" name="kode" class="form-control" value="{{ $sub->kode }}" required>
            </div>

            <h5 class="mt-4">Daftar Hasil Temuan</h5>

            <div id="container-hasil-temuan">

                {{-- LOOP DATA EXISTING --}}
                @foreach ($sub->hasilTemuans as $hasil)
                    <div class="row mb-2 hasil-temuan-row">

                        <input type="hidden" name="id_hasil_temuan[]" value="{{ $hasil->id }}">

                        <div class="col-10">
                            <input type="text" name="hasil_temuan_existing[]" class="form-control"
                                value="{{ $hasil->hasil_temuan }}" required>
                        </div>

                        <div class="col-2">
                            <button type="button" class="btn btn-danger w-100 btn-remove">
                                Hapus
                            </button>
                        </div>
                    </div>
                @endforeach

            </div>

            {{-- Tombol tambah baris --}}
            <button type="button" class="btn btn-secondary mt-2" id="btn-tambah">
                + Tambah Hasil Temuan
            </button>

            <br><br>

            {{-- Wadah untuk id hasil temuan yang dihapus --}}
            <input type="hidden" name="deleted_ids" id="deleted-ids">

            <button class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    {{-- SCRIPT --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const container = document.getElementById("container-hasil-temuan");
            const btnTambah = document.getElementById("btn-tambah");
            const deletedIdsInput = document.getElementById("deleted-ids");
            let deletedIds = [];

            btnTambah.addEventListener("click", function() {

                const row = document.createElement("div");
                row.classList.add("row", "mb-2", "hasil-temuan-row");

                row.innerHTML = `
            <input type="hidden" name="id_hasil_temuan[]" value="new">

            <div class="col-10">
                <input type="text" name="hasil_temuan_existing[]" class="form-control"
                       placeholder="Masukkan hasil temuan baru" required>
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

                    const row = event.target.closest(".hasil-temuan-row");

                    const hiddenInput = row.querySelector('input[name="id_hasil_temuan[]"]');

                    // Jika bukan "new" berarti existing → tandai untuk dihapus
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

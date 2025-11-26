<!-- Tombol untuk membuka modal -->
<button role="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
    data-bs-target=".formEditKriteria{{ $kriteria->id }}">
    <i class="fas fa-edit"></i> <span class="d-none d-sm-inline">Edit</span>
</button>

<!-- Modal -->
<div class="modal fade formEditKriteria{{ $kriteria->id }}" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <form method="POST" action="{{ route('admin.temuan.update', $kriteria->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="modalFormLabel">Edit Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-left">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Nama Kriteria <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama"
                                    value="{{ old('nama', $kriteria->nama) }}" required>
                            </div>
                        </div>

                    </div>

                    <hr>

                    <h5 class="mb-2">Subkriteria</h5>

                    @foreach ($kriteria->subkriteria as $sub)
                        <div class="border rounded p-3 mb-3">

                            <div class="row">

                                <div class="col-md-4">
                                    <label class="form-label">Kode Sub</label>
                                    <input type="text" name="subkriteria[{{ $sub->id }}][kode]"
                                        value="{{ $sub->kode }}" class="form-control">
                                </div>

                                <div class="col-md-8">
                                    <label class="form-label">Judul Sub</label>
                                    <input type="text" name="subkriteria[{{ $sub->id }}][judul]"
                                        value="{{ $sub->judul }}" class="form-control">
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary btn-submit">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="btn-text">Save</span>
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

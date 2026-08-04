<!-- Tombol untuk membuka modal -->
<button role="button" class="btn-crud btn-crud-warning btn-crud-sm" data-bs-toggle="modal"
    data-bs-target=".formEditKriteria{{ $kriteria->id }}">
    <i class="fas fa-edit"></i> <span class="d-none d-sm-inline">Edit</span>
</button>

<!-- Modal -->
<div class="modal fade formEditKriteria{{ $kriteria->id }} modal-crud" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <form method="POST" action="{{ route('admin.temuan.update', $kriteria->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel"><i class="fas fa-edit mr-2"></i>Edit Kriteria</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-left">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Kriteria <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama"
                                    value="{{ old('nama', $kriteria->nama) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi kriteria (opsional)">{{ old('deskripsi', $kriteria->deskripsi ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h6 class="mb-3" style="font-weight:700;color:#0c3366;">
                        <i class="fas fa-sitemap mr-1"></i> Subkriteria
                    </h6>

                    @forelse ($kriteria->subkriterias as $sub)
                        <div class="border rounded p-3 mb-3" style="background:#f8f9fc;">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Kode Sub</label>
                                    <input type="text" name="subkriteria[{{ $sub->id }}][kode]"
                                        value="{{ $sub->kode }}" class="form-control">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Judul Sub</label>
                                    <input type="text" name="subkriteria[{{ $sub->id }}][judul]"
                                        value="{{ $sub->judul ?? '' }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-3" style="color:#6c757d;">
                            <i class="fas fa-info-circle mr-1"></i> Belum ada subkriteria
                        </div>
                    @endforelse

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-crud btn-crud-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>

                    <button type="submit" class="btn-crud btn-crud-primary btn-submit">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <i class="fas fa-save mr-1"></i> <span class="btn-text">Simpan</span>
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

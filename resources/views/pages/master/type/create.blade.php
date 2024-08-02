<!-- Modal -->
<div class="modal fade" id="createModal" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tipe Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formAddUnit" action="{{ route('master.types.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="code">Kode <small style="font-size: 11px;" class="text-primary">(Kode Tipe terisi
                                secara otomatis)</small></label>
                        <input class="form-control" type="text" name="code" id="code" value="{{ $productTypeCode }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Tipe<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="ex. mililiter">
                    </div>
                    <div class="form-group my-3">
                        <label for="desc">Deskripsi Tipe</label>
                        <input class="form-control" type="text" name="desc" id="desc">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" id="btnSubmit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
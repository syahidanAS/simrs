<!-- Modal -->
<div class="modal fade" id="createModal" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Satuan Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formAddIndustry" action="{{ route('master.industries.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="code">Kode<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="code" id="code" value="{{ $industryGroup }}"
                            readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Nama Perusahaan Manufaktur<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="ex. Pt. Kimia Farma">
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone">No. Telepon Perusahaan<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="phone" id="phone" placeholder="ex. 0822xxx">
                    </div>
                    <div class="form-group mb-3">
                        <label for="city">Kota Perusahaan<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="city" id="city" placeholder="ex. Jakarta Pusat">
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Alamat<span class="text-danger">*</span></label>
                        <textarea class="form-control" type="text" name="address" id="address"></textarea>
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
<!-- Modal -->
<div class="modal fade" id="editModal" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Perbaharui Data Satuan Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditIndustry" action="{{ route('master.industries.update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input class="form-control" type="text" name="idEdit" id="idEdit" hidden>
                    <div class="form-group mb-3">
                        <label for="codeEdit">Kode<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="codeEdit" id="codeEdit" placeholder="ex. ml"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="nameEdit">Nama Perusahaan/Manufaktur<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nameEdit" id="nameEdit"
                            placeholder="ex. PT. Kimia Farma" required>
                    </div>
                    <div class="form-group">
                        <label for="phoneEdit">No. Telepon<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="phoneEdit" id="phoneEdit"
                            placeholder="ex. mililiter" required>
                    </div>
                    <div class="form-group">
                        <label for="cityEdit">Kota<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="cityEdit" id="cityEdit"
                            placeholder="ex. mililiter" required>
                    </div>
                    <div class="form-group">
                        <label for="addressEdit">Kota<span class="text-danger">*</span></label>
                        <textarea class="form-control" type="text" name="addressEdit" id="addressEdit"
                            placeholder="ex. mililiter" required> </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" id="btnEdit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
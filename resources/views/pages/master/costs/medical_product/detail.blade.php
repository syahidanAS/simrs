<!-- Modal Detail-->
<div class="modal fade" id="detailProductModal" tabindex="-1" aria-labelledby="detailProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailProductModalLabel">Informasi Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-striped" id="table-detail">
                    <tr>
                        <td>Nama Produk</td>
                        <td>:</td>
                        <th id="productName"></th>
                    </tr>
                    <tr>
                        <td>Industri</td>
                        <td>:</td>
                        <td id="productIndustry"></td>
                    </tr>
                    <tr>
                        <td>Kode</td>
                        <td>:</td>
                        <td id="code"></td>
                    </tr>
                    <tr>
                        <td>Kode KFA</td>
                        <td>:</td>
                        <td id="kfaCode"></td>
                    </tr>
                    <tr>
                        <td>Isi Satuan Besar</td>
                        <td>:</td>
                        <td>
                            <span id="fill"></span> <span id="largeUnit"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Isi Satuan Kecil</td>
                        <td>:</td>
                        <td>
                            <span id="capacity"></span> <span id="smallUnit"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Kandungan</td>
                        <td>:</td>
                        <td id="content"></td>
                    </tr>
                    <tr>
                        <td>Stok Minimal</td>
                        <td>:</td>
                        <td id="minimumStock"></td>
                    </tr>
                    <tr>
                        <td>Stok Saat Ini</td>
                        <td>:</td>
                        <td id="currentStock"></td>
                    </tr>
                    <tr>
                        <td>Tanggal Kedaluwarsa</td>
                        <td>:</td>
                        <td id="expiredDate"></td>
                    </tr>
                    <tr>
                        <td>Harga Dasar</td>
                        <td>:</td>
                        <td id="basicPrice"></td>
                    </tr>
                    <tr>
                        <td>Harga Beli</td>
                        <td>:</td>
                        <td id="purchasePrice"></td>
                    </tr>
                    <tr>
                        <td>Harga Rawat Jalan</td>
                        <td>:</td>
                        <td id="outpatientPrice"></td>
                    </tr>
                    <tr>
                        <td>Harga Rawat Inap Kelas 1</td>
                        <td>:</td>
                        <td id="inpatientPriceClass1"></td>
                    </tr>
                    <tr>
                        <td>Harga Rawat Inap Kelas 2</td>
                        <td>:</td>
                        <td id="inpatientPriceClass2"></td>
                    </tr>
                    <tr>
                        <td>Harga Rawat Inap Kelas 3</td>
                        <td>:</td>
                        <td id="inpatientPriceClass3"></td>
                    </tr>
                    <tr>
                        <td>Harga Rawat Inap BPJS</td>
                        <td>:</td>
                        <td id="inpatientPriceBpjs"></td>
                    </tr>
                    <tr>
                        <td>Harga Rawat Inap VIP</td>
                        <td>:</td>
                        <td id="inpatientPriceVip"></td>
                    </tr>
                    <tr>
                        <td>Harga Rawat Inap VVIP</td>
                        <td>:</td>
                        <td id="inpatientPriceVvip"></td>
                    </tr>

                </table>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
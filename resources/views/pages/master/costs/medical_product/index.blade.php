@extends('layouts.app', ['title' => 'Master Obat dan Alat Kesehatan'])
@section('content')
<style>
    #table-detail td:first-child {
        width: 30%;
        /* Atur sesuai kebutuhan */
    }

    #table-detail td:nth-child(2) {
        width: 2%;
        /* Atur sesuai kebutuhan */
    }

    #table-detail td:last-child {
        width: 70%;
        /* Atur sesuai kebutuhan */
    }
</style>
<div class="app-content my-4">
    <div class="container">
        <div class="row mx-2 my-2 gap-2">
            <a type="button" class="btn btn-secondary btn-sm col-sm-2" href="#">
                Master Kategori</a>
            <a type="button" class="btn btn-secondary btn-sm col-sm-2" href="#">
                Master Industri</a>
            <a type="button" class="btn btn-secondary btn-sm col-sm-2" href="#">
                Master Kelompok</a>
            <a type="button" class="btn btn-secondary btn-sm col-sm-2" href="#">
                Master Tipe</a>
            <a type="button" class="btn btn-secondary btn-sm col-sm-2" href="#">
                Master Satuan</a>
        </div>
        <div class="card table-responsive">
            <div class="card-header">
                <h5 class="card-title col-sm-10">Master Obat dan Alat Kesehatan</h5>
                <a type="button" class="btn btn-primary btn-sm col-sm-2"
                    href="{{ route('master.cost.products.create') }}">+
                    Tambah Data</a>
            </div>
            <div class="card-body table-responsive">
                <div class="d-flex justify-content-between mb-3"></div>
                <table class="table table-striped table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Kode KFA</th>
                            <th>Nama Produk</th>
                            <th>Kandungan</th>
                            <th>Satuan Besar</th>
                            <th>Isi</th>
                            <th>Satuan Kecil</th>
                            <th>Kapasitas</th>
                            <th>Harga Dasar</th>
                            <th>Stok Saat Ini</th>
                            <th>Stok Minimal</th>
                            <th>expired_date</th>
                            <th class="text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="card-footer">
                <!-- Optional footer content -->
            </div>
        </div>
    </div>
</div>

@include('pages.master.costs.medical_product.detail')


@endsection

@section('scriptjs')
<script>
    $(document).ready(function () {
        $(function () {
            $("#datatable").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('master.cost.product-prices') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'code', name: 'code' },
                    { data: 'kfa_code', name: 'kfa_code' },
                    { data: 'name', name: 'name' },
                    { data: 'content', name: 'content' },
                    { data: 'large_unit', name: 'large_unit' },
                    { data: 'fill', name: 'fill' },
                    { data: 'small_unit', name: 'small_unit' },
                    { data: 'capacity', name: 'capacity' },
                    { data: 'basic_price', name: 'basic_price' },
                    { data: 'current_stock', name: 'current_stock' },
                    { data: 'minimum_stock', name: 'minimum_stock' },
                    { data: 'expired_date', name: 'expired_date' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                "responsive": true, "lengthChange": true, "autoWidth": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });


        $(document).on('click', '#btnDetailProduct', function () {
            let id = $(this).data('id');
            $('#detailProductModal').modal('show');

            $.ajax({
                type: 'GET',
                url: '{{ route("master.cost.product-prices.detail", ":id") }}'.replace(':id', id),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#productName').html(response.data.name);
                    $('#productIndustry').html(response.data.industry.name);
                    $('#code').html(response.data.code);
                    $('#kfaCode').html(response.data.kfa_code);
                    $('#largeUnit').html(response.data.large_unit.name);
                    $('#fill').html(response.data.fill);
                    $('#smallUnit').html(response.data.small_unit.name);
                    $('#capacity').html(response.data.capacity);
                    $('#minimumStock').html(response.data.minimum_stock);
                    $('#content').html(response.data.content);
                    $('#currentStock').html(response.data.current_stock);
                    $('#expiredDate').html(response.data.expired_date);
                    $('#basicPrice').html(formatRupiah(response.data.basic_price));
                    $('#purchasePrice').html(formatRupiah(response.data.purchase_price));
                    $('#outpatientPrice').html(formatRupiah(response.data.outpatient_price));
                    $('#inpatientPriceClass1').html(formatRupiah(response.data.inpatient_price_class_1));
                    $('#inpatientPriceClass2').html(formatRupiah(response.data.inpatient_price_class_2));
                    $('#inpatientPriceClass3').html(formatRupiah(response.data.inpatient_price_class_3));
                    $('#inpatientPriceBpjs').html(formatRupiah(response.data.inpatient_price_bpjs));
                    $('#inpatientPriceVip').html(formatRupiah(response.data.inpatient_price_vip));
                    $('#inpatientPriceVvip').html(formatRupiah(response.data.inpatient_price_vvip));


                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        text: xhr.responseJSON.message,
                        showCloseButton: true,
                        confirmButtonText: 'Coba Lagi',
                    });
                }
            });
        });

    });
    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
    }

</script>
@endsection
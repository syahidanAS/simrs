@extends('layouts.app', ['title' => 'Master Obat dan Alat Kesehatan'])
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                @php
                $currentRouteName = Route::current()->uri();
                @endphp
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $currentRouteName }}</a>
                </li>
            </ol>
        </div>
        <div class="card">
            <div class=" card-header">
                <h5 class="card-title col-sm-6">Master Dokter</h5>
                <div class="row">
                    <div class="basic-dropdown col-sm">
                        <div class="dropdown">
                            <button type="button" class="btn btn-secondary dropdown-toggle btn-sm"
                                data-bs-toggle="dropdown">
                                Master Data Pendukung
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('master.units') }}">Satuan Produk</a>
                                <a class="dropdown-item" href="{{ route('master.types') }}">Tipe Produk</a>
                                <a class="dropdown-item" href="{{ route('master.categories') }}">Kategori Produk</a>
                                <a class="dropdown-item" href="{{ route('master.groups') }}">Golongan Produk</a>
                            </div>
                        </div>
                    </div>
                    <a type="button" class="btn btn-primary btn-sm col-sm"
                        href="{{ route('master.cost.products.create') }}">+
                        Tambah Data</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <div class="d-flex justify-content-between mb-3"></div>
                <table class="table table-striped table-bordered w-100" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Kode KFA</th>
                            <th>Nama Produk</th>
                            <th>Kandungan</th>
                            <th>Harga Dasar</th>
                            <th class="text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    @include('pages.master.costs.medical_product.detail')
</div>

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
                    { data: 'product_name', name: 'product_name' },
                    { data: 'content', name: 'content' },
                    { data: 'basic_price', name: 'basic_price' },
                    { data: 'action', name: 'action', orderable: true, searchable: true },
                ],
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
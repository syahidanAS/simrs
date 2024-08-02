@extends('layouts.app', ['title' => 'Obat dan Alat Kesehatan'])
@section('content')
<div class="app-content my-4">
    <form id="formTambahDokter" action="{{ route('master.cost.product-prices.store') }}" method="POST">
        @csrf
        <div class="container">
            <div class="d-flex justify-content-between text-center">
                <h5>Tambah Obat dan Alat Kesehatan</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('master.cost.product-prices') }}"><i
                        class="bi bi-chevron-left"></i>Kembali</a>
            </div>
            <div class="card-body pt-4 row">
                <div class="col-sm-6">
                    <div class="mb-3 form-group">
                        <label for="kfa_code">Kode Produk</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ $countProduct }}"
                            readonly>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="kfa_code">Kode KFA<span class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="name" id="name" placeholder="ex. 92000384">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="name">Nama Produk<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" id="name"
                            placeholder="ex. Paracetamol 60 mg / 0,6 mL Drops">
                    </div>
                    <div class=" form-group">
                        <label for="industry_id" class="form-label" required>Nama Industri (Distributor/Manufaktur)<span
                                class="text-danger">*</span></label>
                        <select class="form-select col-sm-2 industry" id="industry_id" name="industry_id">
                            <option value="">Pilih Industri</option>
                        </select>
                    </div>

                    <div class="row form-group">
                        <label for="large_unit_id" class="form-label" required>Satuan Besar<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <select class="form-select col-sm-2 large_unit_id" id="large_unit_id" name="large_unit_id">
                                <option value="">Pilih Satuan Besar</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control col-sm-2" type="number" name="fill" id="fill"
                                style="height: 35px;">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="small_unit_id" class="form-label" required>Satuan Kecil<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <select class="form-select col-sm-2 small_unit_id" id="small_unit_id" name="small_unit_id">
                                <option value="">Pilih Satuan Kecil</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control col-sm-2" type="number" name="capacity" id="capacity"
                                style="height: 35px;">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="type_id" class="form-label" required>Tipe Produk<span
                                class="text-danger">*</span></label>
                        <select class="form-select col-sm-2 type_id" id="type_id" name="type_id">
                            <option value="">Pilih Tipe Produk</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="category_id" class="form-label" required>Kategori Produk<span
                                class="text-danger">*</span></label>
                        <select class="form-select col-sm-2 category_id" id="category_id" name="category_id">
                            <option value="">Pilih Kategori Produk</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="group_id" class="form-label" required>Golongan Produk<span
                                class="text-danger">*</span></label>
                        <select class="form-select col-sm-2 group_id" id="group_id" name="group_id">
                            <option value="">Pilih Golongan Produk</option>
                        </select>
                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="mb-3 form-group">
                        <label for="minimum_stock">Stok Minimal<span
                            class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="minimum_stock" id="minimum_stock">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="current_stock">Stok Saat Ini<span
                            class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="current_stock" id="current_stock">
                    </div>

                    <div class="mb-3 form-group">
                        <label for="outpatient_price">Harga Pasien Ralan</label>
                        <input class="form-control" type="number" name="outpatient_price" id="outpatient_price" />
                    </div>

                    <div class="mb-3 form-group">
                        <label for="inpatient_price_class_1">Harga Pasien Ranap (Kelas 1)</label>
                        <input class="form-control" type="number" name="inpatient_price_class_1"
                            id="inpatient_price_class_1" />
                    </div>
                    <div class="mb-3 form-group">
                        <label for="inpatient_price_class_2">Harga Pasien Ranap (Kelas 2)</label>
                        <input class="form-control" type="number" name="inpatient_price_class_2"
                            id="inpatient_price_class_2" />
                    </div>
                    <div class="mb-3 form-group">
                        <label for="inpatient_price_class_3">Harga Pasien Ranap (Kelas 3)</label>
                        <input class="form-control" type="number" name="inpatient_price_class_3"
                            id="inpatient_price_class_3" />
                    </div>

                    <div class="mb-3 form-group">
                        <label for="inpatient_price_bpjs">Harga Pasien Ranap BPJS</label>
                        <input class="form-control" type="number" name="inpatient_price_bpjs"
                            id="inpatient_price_bpjs" />
                    </div>

                    <div class="mb-3 form-group">
                        <label for="inpatient_price_vip">Harga Pasien Ranap VIP</label>
                        <input class="form-control" type="number" name="inpatient_price_vip" id="inpatient_price_vip" />
                    </div>

                    <div class="mb-3 form-group">
                        <label for="inpatient_price_vvip">Harga Pasien Ranap VVIP</label>
                        <input class="form-control" type="number" name="inpatient_price_vvip"
                            id="inpatient_price_vvip" />
                    </div>

                    <div class="mb-3 form-group">
                        <label for="content">Kandungan</label>
                        <textarea class="form-control" type="text" name="content" id="content"></textarea>
                    </div>


                </div>
            </div>
            <hr>
            <button id="btnSubmit" type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection

@section('scriptjs')
<script>
    let industryUrl = "{{ route('master.cost.product-prices.industries') }}";
    let unitUrl = "{{ route('master.cost.product-prices.units') }}";
    let typeUrl = "{{ route('master.cost.product-prices.types') }}";
    let categoryUrl = "{{ route('master.cost.product-prices.categories') }}";
    let groupUrl = "{{ route('master.cost.product-prices.types') }}";

    $(document).ready(function () {
        $(".industry").select2({
            ajax: {
                url: industryUrl,
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name
                        }))
                    };
                },
                cache: true
            }
        });

        $(".large_unit_id").select2({
            ajax: {
                url: unitUrl,
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name
                        }))
                    };
                },
                cache: true
            }
        });

        $(".small_unit_id").select2({
            ajax: {
                url: unitUrl,
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name
                        }))
                    };
                },
                cache: true
            }
        });



        $(".type_id").select2({
            ajax: {
                url: typeUrl,
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name
                        }))
                    };
                },
                cache: true
            }
        });

        $(".category_id").select2({
            ajax: {
                url: categoryUrl,
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name
                        }))
                    };
                },
                cache: true
            }
        });

        $(".group_id").select2({
            ajax: {
                url: groupUrl,
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name
                        }))
                    };
                },
                cache: true
            }
        });

    });
</script>
@endsection
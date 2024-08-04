@extends('layouts.app', ['title' => 'Perbaharui Obat dan Alat Kesehatan'])
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
        <form class="card" id="formUpdateProduct" action="{{ route('master.cost.product-prices.update') }}"
            method="POST">
            @csrf
            <div class="container">
                <div class="d-flex justify-content-between text-center">
                    <h5>Perbaharui Obat dan Alat Kesehatan</h5>
                    <a class="btn btn-secondary btn-sm" href="{{ route('master.cost.product-prices') }}"><i
                            class="bi bi-chevron-left"></i>Kembali</a>
                </div>
                <div class="card-body pt-4 row">
                    <div class="col-sm-6">
                        <input type="text" id="id" name="id" value="{{ $data->id }}" hidden>
                        <div class="mb-3 form-group">
                            <label for="kfa_code">Kode Produk</label>
                            <input class="form-control" type="text" name="code" id="code" value="{{ $data->code }}"
                                readonly>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="kfa_code">Kode KFA<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="kfa_code" id="kfa_code"
                                placeholder="ex. 92000384" value="{{$data->kfa_code}}">
                        </div>
                        <div class="mb-3 form-group">
                            <label for="name">Nama Produk<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" id="name"
                                placeholder="ex. Paracetamol 60 mg / 0,6 mL Drops" value="{{$data->name}}">
                        </div>
                        <div class=" form-group">
                            <label for="industry_id" class="form-label" required>Nama Industri
                                (Distributor/Manufaktur)<span class="text-danger">*</span></label>
                            <select class="form-select col-sm-2 industry" id="industry_id" name="industry_id">
                                <option value="">Pilih Industri</option>
                            </select>
                        </div>

                        <div class="row form-group my-2">
                            <label for="large_unit_id" class="form-label" required>Satuan Besar<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-select col-sm-2 large_unit_id" id="large_unit_id"
                                    name="large_unit_id">
                                    <option value="">Pilih Satuan Besar</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control col-sm-2" type="number" name="fill" id="fill"
                                    style="height: 35px;" value="{{ $data->fill }}">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label for="small_unit_id" class="form-label" required>Satuan Kecil<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-select col-sm-2 small_unit_id" id="small_unit_id"
                                    name="small_unit_id">
                                    <option value="">Pilih Satuan Kecil</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control col-sm-2" type="number" name="capacity" id="capacity"
                                    style="height: 35px;" value="{{ $data->capacity }}">
                            </div>
                        </div>


                        <div class="form-group mt-2">
                            <label for="type_id" class="form-label" required>Tipe Produk<span
                                    class="text-danger">*</span></label>
                            <select class="form-select col-sm-2 type_id" id="type_id" name="type_id">
                                <option value="">Pilih Tipe Produk</option>
                            </select>
                        </div>


                        <div class="form-group my-4">
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

                        <div class="my-4 form-group">
                            <label for="expired_date">Tanggal Kedaluwarsa<span class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="expired_date" id="expired_date"
                                value="{{$data->expired_date}}">
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3 form-group">
                            <label for="minimum_stock">Stok Minimal<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="minimum_stock" id="minimum_stock"
                                value="{{$data->minimum_stock}}">
                        </div>
                        <div class="mb-3 form-group">
                            <label for="current_stock">Stok Saat Ini<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="current_stock" id="current_stock"
                                value="{{$data->current_stock}}">
                        </div>

                        <div class="mb-3 form-group">
                            <label for="basic_price">Harga Dasar<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="basic_price" id="basic_price"
                                value="{{$data->basic_price}}" />
                        </div>

                        <div class="mb-3 form-group">
                            <label for="purchase_price">Harga Beli<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="purchase_price" id="purchase_price" />
                        </div>  

                        <div class="mb-3 form-group">
                            <label for="outpatient_price">Harga Pasien Ralan</label>
                            <input class="form-control" type="number" name="outpatient_price" id="outpatient_price"
                                value="{{$data->outpatient_price}}" />
                        </div>

                        <div class="mb-3 form-group">
                            <label for="inpatient_price_class_1">Harga Pasien Ranap (Kelas 1)</label>
                            <input class="form-control" type="number" name="inpatient_price_class_1"
                                id="inpatient_price_class_1" value="{{ $data->inpatient_price_class_1 }}" />
                        </div>
                        <div class="mb-3 form-group">
                            <label for="inpatient_price_class_2">Harga Pasien Ranap (Kelas 2)</label>
                            <input class="form-control" type="number" name="inpatient_price_class_2"
                                id="inpatient_price_class_2" value="{{ $data->inpatient_price_class_2 }}" />
                        </div>
                        <div class="mb-3 form-group">
                            <label for="inpatient_price_class_3">Harga Pasien Ranap (Kelas 3)</label>
                            <input class="form-control" type="number" name="inpatient_price_class_3"
                                id="inpatient_price_class_3" value="{{ $data->inpatient_price_class_3 }}" />
                        </div>

                        <div class="mb-3 form-group">
                            <label for="inpatient_price_bpjs">Harga Pasien Ranap BPJS</label>
                            <input class="form-control" type="number" name="inpatient_price_bpjs"
                                id="inpatient_price_bpjs" value="{{$data->inpatient_price_bpjs}}" />
                        </div>

                        <div class="mb-3 form-group">
                            <label for="inpatient_price_vip">Harga Pasien Ranap VIP</label>
                            <input class="form-control" type="number" name="inpatient_price_vip"
                                id="inpatient_price_vip" value="{{ $data->inpatient_price_vip }}" />
                        </div>

                        <div class="mb-3 form-group">
                            <label for="inpatient_price_vvip">Harga Pasien Ranap VVIP</label>
                            <input class="form-control" type="number" name="inpatient_price_vvip"
                                id="inpatient_price_vvip" value="{{ $data->inpatient_price_vvip }}" />
                        </div>

                        <div class="mb-3 form-group">
                            <label for="content">Kandungan</label>
                            <textarea class="form-control" type="text" name="content"
                                id="content">{{ $data->content }}</textarea>
                        </div>


                    </div>
                </div>
                <div class="card-footer">
                    <button id="btnSubmit" type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scriptjs')
<script>
    let industryUrl = "{{ route('master.cost.product-prices.industries') }}";
    let unitUrl = "{{ route('master.cost.product-prices.units') }}";
    let typeUrl = "{{ route('master.cost.product-prices.types') }}";
    let categoryUrl = "{{ route('master.cost.product-prices.categories') }}";
    let groupUrl = "{{ route('master.cost.product-prices.groups') }}";

    $(document).ready(function () {
        $('#formUpdateProduct').on('submit', function (event) {
            event.preventDefault();
            var form = this;
            $('#btnSubmit').addClass('disabled');
            $('#code').removeClass('is-invalid');
            $('#kfa_code').removeClass('is-invalid');
            $('#name').removeClass('is-invalid');
            $('#industry_id').removeClass('is-invalid');
            $('#large_unit_id').removeClass('is-invalid');
            $('#small_unit_id').removeClass('is-invalid');
            $('#fill').removeClass('is-invalid');
            $('#capacity').removeClass('is-invalid');
            $('#type_id').removeClass('is-invalid');
            $('#category_id').removeClass('is-invalid');
            $('#group_id').removeClass('is-invalid');
            $('#expired_date').removeClass('is-invalid');
            $('#content').removeClass('is-invalid');
            $('#current_stock').removeClass('is-invalid');
            $('#minimum_stock').removeClass('is-invalid');
            $.ajax({
                type: 'POST',
                url: $(form).attr('action'),
                data: new FormData(form),
                processData: false, contentType: false,
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        text: response.message,
                        showCloseButton: true,
                        confirmButtonText: 'Lanjutkan',
                    })
                    $('#btnSubmit').removeClass('disabled');

                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        text: xhr.responseJSON.message,
                        showCloseButton: true,
                        confirmButtonText: 'Coba Lagi',
                    });
                    $('#btnSubmit').removeClass('disabled');

                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        if (errors.code) {
                            $('#code').addClass('is-invalid');
                        }
                        if (errors.kfa_code) {
                            $('#kfa_code').addClass('is-invalid');
                        }
                        if (errors.name) {
                            $('#name').addClass('is-invalid');
                        }
                        if (errors.industry_id) {
                            $('#industry_id').addClass('is-invalid');
                        }
                        if (errors.large_unit_id) {
                            $('#large_unit_id').addClass('is-invalid');
                        }
                        if (errors.small_unit_id) {
                            $('#small_unit_id').addClass('is-invalid');
                        }
                        if (errors.fill) {
                            $('#fill').addClass('is-invalid');
                        }
                        if (errors.capacity) {
                            $('#capacity').addClass('is-invalid');
                        }
                        if (errors.type_id) {
                            $('#type_id').addClass('is-invalid');
                        }
                        if (errors.category_id) {
                            $('#category_id').addClass('is-invalid');
                        }
                        if (errors.expired_date) {
                            $('#expired_date').addClass('is-invalid');
                        }
                        if (errors.group_id) {
                            $('#group_id').addClass('is-invalid');
                        }
                        if (errors.content) {
                            $('#content').addClass('is-invalid');
                        }
                        if (errors.current_stock) {
                            $('#current_stock').addClass('is-invalid');
                        }
                        if (errors.minimum_stock) {
                            $('#minimum_stock').addClass('is-invalid');
                        }
                    }
                }
            })
        })

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

        let selectedSpecialist = '{{ $data->industry->id }}';
        let newIndustry = new Option('{{ $data->industry->name }}', selectedSpecialist, true, true);
        $("#industry_id").append(newIndustry).trigger('change');

        let selectedLargeUnit = '{{ $data->largeUnit->id }}';
        let newLargeUnit = new Option('{{ $data->largeUnit->name }}', selectedLargeUnit, true, true);
        $("#large_unit_id").append(newLargeUnit).trigger('change');

        let selectedSmallUnit = '{{ $data->smallUnit->id }}';
        let newSmallUnit = new Option('{{ $data->smallUnit->name }}', selectedSmallUnit, true, true);
        $("#small_unit_id").append(newSmallUnit).trigger('change');

        let selectedType = '{{ $data->type->id }}';
        let newType = new Option('{{ $data->type->name }}', selectedType, true, true);
        $("#type_id").append(newType).trigger('change');

        let selectedCategory = '{{ $data->category->id }}';
        let newCategory = new Option('{{ $data->category->name }}', selectedCategory, true, true);
        $("#category_id").append(newCategory).trigger('change');

        let selectedGroup = '{{ $data->group->id }}';
        let newGroup = new Option('{{ $data->group->name }}', selectedGroup, true, true);
        $("#group_id").append(newGroup).trigger('change');
    });
</script>
@endsection
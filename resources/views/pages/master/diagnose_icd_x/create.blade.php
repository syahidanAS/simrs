@extends('layouts.app', ['title' => 'Tambah ICD-X'])
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
        <form class="card p-4" id="formTambahIcdx" action="{{ route('master.diagnose.icd_x.store') }}" method="POST">
            @csrf
            <div class="d-flex justify-content-between text-center">
                <h5>Tambah Diagnosa ICD-X</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('master.diagnose.icd_x') }}"><i
                        class="bi bi-chevron-left"></i>Kembali</a>
            </div>
            <div class="card-body pt-4 row">
                <div class="col-sm-6">
                    <div class="mb-3 form-group">
                        <label for="code">Kode Diagnosa<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="code" id="code" placeholder="ex. B20.0">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="name_en">Nama Diagnosa <small>(Dalam Bahasa Inggris)</small><span
                                class="text-danger">*</span>
                        </label>
                        <input class="form-control" type="text" name="name_en" id="name_en"
                            placeholder="ex. HIV disease resulting in mycobacterial infection">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="name_id">Nama Diagnosa <small>(Dalam Bahasa Indonesia)</small><span
                                class="text-danger">*</span>
                        </label>
                        <input class="form-control" type="text" name="name_id" id="name_id"
                            placeholder="ex. Penyakit HIV mengakibatkan infeksi mikobakteri">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button id="btnSubmit" type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scriptjs')
<script>
    $(document).ready(function () {
        $('#formTambahIcdx').on('submit', function (event) {
            event.preventDefault();
            var form = this;
            $('#btnSubmit').addClass('disabled');
            $('#code').removeClass('is-invalid');
            $('#name_en').removeClass('is-invalid');
            $('#name_id').removeClass('is-invalid');
            $.ajax({
                type: 'POST',
                url: $(form).attr('action'),
                data: new FormData(form),
                processData: false, contentType: false,
                success: function (response) {
                    $('#btnSubmit').removeClass('disabled');
                    Swal.fire({
                        icon: "success",
                        text: response.message,
                        showCloseButton: true,
                        confirmButtonText: 'Lanjutkan',
                    })
                    document.getElementById('formTambahIcdx').reset();
                    $('#btnSubmit').remove('disabled');
                },
                error: function (xhr, status, error) {
                    $('#btnSubmit').removeClass('disabled');
                    Swal.fire({
                        icon: "error",
                        text: xhr.responseJSON.message,
                        showCloseButton: true,
                        confirmButtonText: 'Coba Lagi',
                    });
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        if (errors.code) {
                            $('#code').addClass('is-invalid');
                        }
                        if (errors.name_en) {
                            $('#name_en').addClass('is-invalid');
                        }
                        if (errors.name_id) {
                            $('#name_id').addClass('is-invalid');
                        }
                    }
                }
            })
        })
    });
</script>
@endsection
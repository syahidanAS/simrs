@extends('layouts.app', ['title' => 'Tambah ICD-IX CM'])
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
        <form class="card p-4" id="formTambahIcdIx" action="{{ route('master.procedure.icd_ix_cm.store') }}"
            method="POST">
            @csrf
            <div class="d-flex justify-content-between text-center">
                <h5>Tambah Prosedur ICD-IX CM</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('master.procedure.icd_ix_cm') }}"><i
                        class="bi bi-chevron-left"></i>Kembali</a>
            </div>
            <div class="card-body pt-4 row">
                <div class="col-sm-6">
                    <div class="mb-3 form-group">
                        <label for="code">Kode Prosedur<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="code" id="code" placeholder="ex. 40.61">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="name">Nama Prosedure<span class="text-danger">*</span>
                        </label>
                        <input class="form-control" type="text" name="name" id="name"
                            placeholder="ex. Cannulation of thoracic duct">
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
        $('#formTambahIcdIx').on('submit', function (event) {
            event.preventDefault();
            var form = this;
            $('#btnSubmit').addClass('disabled');
            $('#code').removeClass('is-invalid');
            $('#name').removeClass('is-invalid');
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
                    document.getElementById('formTambahIcdIx').reset();
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
                        if (errors.name) {
                            $('#name').addClass('is-invalid');
                        }
                    }
                }
            })
        })
    });
</script>
@endsection
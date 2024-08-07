@extends('layouts.app', ['title' => 'Ubah ICD-IX CM'])
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
        <form class="card p-4" id="formEditIcdIx" action="{{ route('master.procedure.icd_ix_cm.update') }}"
            method="POST">
            @csrf
            <div class="d-flex justify-content-between text-center">
                <h5>Ubah Prosedur ICD-IX CM</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('master.procedure.icd_ix_cm') }}"><i
                        class="bi bi-chevron-left"></i>Kembali</a>
            </div>
            <div class="card-body pt-4 row">
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="idEdit" id="idEdit" value="{{ $data->id }}" hidden>
                    <div class="mb-3 form-group">
                        <label for="codeEdit">Kode Prosedur<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="codeEdit" id="codeEdit" placeholder="ex. 40.61"
                            value="{{ $data->code }}">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="nameEdit">Nama Prosedure<span class="text-danger">*</span>
                        </label>
                        <input class="form-control" type="text" name="nameEdit" id="nameEdit"
                            placeholder="ex. Cannulation of thoracic duct" value="{{ $data->name }}">
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
        $('#formEditIcdIx').on('submit', function (event) {
            event.preventDefault();
            var form = this;
            $('#btnSubmit').addClass('disabled');
            $('#codeEdit').removeClass('is-invalid');
            $('#nameEdit').removeClass('is-invalid');
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
                            $('#codeEdit').addClass('is-invalid');
                        }
                        if (errors.name) {
                            $('#nameEdit').addClass('is-invalid');
                        }
                    }
                }
            })
        })
    });
</script>
@endsection
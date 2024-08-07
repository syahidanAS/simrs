@extends('layouts.app', ['title' => 'Edit ICD-X'])
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
        <form class="card p-4" id="formEditIcdx" action="{{ route('master.diagnose.icd_x.update') }}" method="POST">
            @csrf
            <div class="d-flex justify-content-between text-center">
                <h5>Edit Diagnosa ICD-X</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('master.diagnose.icd_x') }}"><i
                        class="bi bi-chevron-left"></i>Kembali</a>
            </div>
            <div class="card-body pt-4 row">
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="idEdit" id="idEdit" placeholder="ex. B20.0"
                        value="{{ $data->id }}" hidden>
                    <div class="mb-3 form-group">
                        <label for="codeEdit">Kode Diagnosa<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="codeEdit" id="codeEdit" placeholder="ex. B20.0"
                            value="{{ $data->code }}">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="name_enEdit">Nama Diagnosa <small>(Dalam Bahasa Inggris)</small><span
                                class="text-danger">*</span>
                        </label>
                        <input class="form-control" type="text" name="name_enEdit" id="name_enEdit"
                            placeholder="ex. HIV disease resulting in mycobacterial infection"
                            value="{{ $data->name_en }}">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="name_idEdit">Nama Diagnosa <small>(Dalam Bahasa Indonesia)</small><span
                                class="text-danger">*</span>
                        </label>
                        <input class="form-control" type="text" name="name_idEdit" id="name_idEdit"
                            placeholder="ex. Penyakit HIV mengakibatkan infeksi mikobakteri"
                            value="{{ $data->name_id }}">
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
        $('#formEditIcdx').on('submit', function (event) {
            event.preventDefault();
            var form = this;
            $('#btnSubmit').addClass('disabled');
            $('#codeEdit').removeClass('is-invalid');
            $('#name_enEdit').removeClass('is-invalid');
            $('#name_idEdit').removeClass('is-invalid');
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
                    // document.getElementById('formEditIcdx').reset();
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
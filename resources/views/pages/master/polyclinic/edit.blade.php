@extends('layouts.app', ['title' => 'Edit Poliklinik'])
@section('content')
<div class="app-content my-4">
    <form id="formTambahPoli" action="{{ route('master.polyclinics.update') }}" method="POST">
        @csrf
        <div class="container">
            <div class="d-flex justify-content-between text-center">
                <h5>Edit Poliklinik</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('master.polyclinics') }}"><i
                        class="bi bi-chevron-left"></i>Kembali</a>
            </div>
            <div class="card-body pt-4 row">
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="id" id="id" placeholder="Masukan nama poliklinik"
                        value="{{ $polyclinic->id }}" hidden>
                    <div class="mb-3 form-group">
                        <label for="name">Nama Poliklinik<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" id="name"
                            placeholder="Masukan nama poliklinik" value="{{ $polyclinic->name }}">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="kd_poli">Kode Poli<span class="text-danger">*</span> <small style="font-size: 11px;"
                                class="text-primary">(Kode poli terisi
                                secara otomatis)</small>
                        </label>
                        <input class="form-control" type="text" name="kd_poli" id="kd_poli"
                            value="{{ $polyclinic->kd_poli }}" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3 form-group">
                        <label for="open_at">Jam Buka Poli<span class="text-danger">*</span></label>
                        <input class="form-control" type="time" name="open_at" id="open_at"
                            value="{{ $polyclinic->open_at }}">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="closed_at">Jam Tutup<span class="text-danger">*</span></label>
                        <input class="form-control" type="time" name="closed_at" id="closed_at"
                            value="{{ $polyclinic->closed_at }}">
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
    $(document).ready(function () {
        $('#formTambahPoli').on('submit', function (event) {
            event.preventDefault();
            var form = this;
            $('#btnSubmit').addClass('disabled');
            $('#name').removeClass('is-invalid');
            $('#kd_poli').removeClass('is-invalid');
            $('#open_at').removeClass('is-invalid');
            $('#closed_at').removeClass('is-invalid');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
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
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        text: xhr.responseJSON.message,
                        showCloseButton: true,
                        confirmButtonText: 'Coba Lagi',
                    });

                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        if (errors.name) {
                            $('#name').addClass('is-invalid');
                        }
                        if (errors.kd_poli) {
                            $('#kd_poli').addClass('is-invalid');
                        }
                        if (errors.action_name) {
                            $('#action_name').addClass('is-invalid');
                        }
                        if (errors.open_at) {
                            $('#open_at').addClass('is-invalid');
                        }
                        if (errors.closed_at) {
                            $('#closed_at').addClass('is-invalid');
                        }
                    }
                }
            })
        })
    });
</script>
@endsection
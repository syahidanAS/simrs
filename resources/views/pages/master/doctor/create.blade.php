@extends('layouts.app', ['title' => 'Tambah Dokter'])
@section('content')
<div class="app-content my-4">
    <form id="formTambahDokter" action="{{ route('master.doctors.store') }}" method="POST">
        @csrf
        <div class="container">
            <div class="d-flex justify-content-between text-center">
                <h5>Tambah Dokter</h5>
                <a class="btn btn-secondary btn-sm" href="{{ route('master.doctors') }}"><i
                        class="bi bi-chevron-left"></i>Kembali</a>
            </div>
            <div class="card-body pt-4 row">
                <div class="col-sm-6">
                    <div class="mb-3 form-group">
                        <label for="id_number">NIK<span class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="id_number" id="id_number"
                            placeholder="Masukan NIK Dokter" maxlength="16" pattern="\d{16}"
                            title="NIK harus terdiri dari 16 digit"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16)">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="name">Nama Dokter<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="Masukan Nama Dokter">
                    </div>
                    <div class="mb-2">
                        <label for="specialist_id" class="form-label" required>Spesialis<span
                                class="text-danger">*</span></label>
                        <select class="form-select specialist_id" id="specialist_id" name="specialist_id"
                            aria-label="specialistIdLabel">
                            <option value="">Pilih Spesialis</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="gender" class="form-label" required>Jenis Kelamin<span
                                class="text-danger">*</span></label>
                        <select class="form-select select2" id="gender" name="gender" aria-label="specialistIdLabel">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="male">Laki-laki</option>
                            <option value="female">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3 form-group">
                        <label for="front_degree">Gelar Depan</label>
                        <input class="form-control" type="text" name="front_degree" id="front_degree"
                            placeholder="ex. dr">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="back_degree">Gelar Belakang</label>
                        <input class="form-control" type="text" name="back_degree" id="back_degree"
                            placeholder="ex. Sp. A">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="phone_number">No. Telepon<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="phone_number" id="phone_number"
                            placeholder="ex. 0822xxx">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="address">Alamat</label>
                        <textarea class="form-control" type="text" name="address" id="address"></textarea>
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
    let specialitiesUrl = "{{ route('master.doctors.specialities-list') }}";
    $(document).ready(function () {
        $('#formTambahDokter').on('submit', function (event) {
            event.preventDefault();
            var form = this;
            $('#btnSubmit').addClass('disabled');
            $('#id_number').removeClass('is-invalid');
            $('#name').removeClass('is-invalid');
            $('#specialist_id').removeClass('is-invalid');
            $('#gender').removeClass('is-invalid');
            $('#front_degree').removeClass('is-invalid');
            $('#back_degree').removeClass('is-invalid');
            $('#phone_number').removeClass('is-invalid');
            $('#address').removeClass('is-invalid');
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
                    document.getElementById('formTambahDokter').reset();
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
                        if (errors.id_number) {
                            $('#id_number').addClass('is-invalid');
                        }
                        if (errors.name) {
                            $('#name').addClass('is-invalid');
                        }
                        if (errors.specialist_id) {
                            $('#specialist_id').addClass('is-invalid');
                        }
                        if (errors.gender) {
                            $('#gender').addClass('is-invalid');
                        }
                        if (errors.front_degree) {
                            $('#front_degree').addClass('is-invalid');
                        }
                        if (errors.back_degree) {
                            $('#back_degree').addClass('is-invalid');
                        }
                        if (errors.phone_number) {
                            $('#phone_number').addClass('is-invalid');
                        }
                        if (errors.address) {
                            $('#address').addClass('is-invalid');
                        }
                    }
                }
            })
        })

        $(".specialist_id").select2({
            ajax: {
                url: specialitiesUrl,
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

        $("#gender").select2({
        });
    });
</script>
@endsection
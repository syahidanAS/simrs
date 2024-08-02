@extends('layouts.app', ['title' => 'Master Tipe Produk'])
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

        <div class="card table-responsive">
            <div class="card-header">
                <h5 class="card-title col-sm-8">Master Tipe Produk</h5>
                <div class="row col-sm-4">
                    <a type="button" class="btn btn-secondary btn-sm col-sm-6"
                        href="{{route('master.cost.product-prices')}}">
                        < Kembali</a>
                            <button id="btnAddType" type="button" class="btn btn-primary btn-sm col-sm-6" href="#"
                                data-bs-toggle="modal" data-bs-target="#createModal">+
                                Tambah Data</button>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3"></div>
                <table class="table table-striped table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    @include('pages.master.type.create')
    @include('pages.master.type.edit')
</div>
@endsection
@section('scriptjs')
<script>
    $(document).ready(function () {
        $('#formAddUnit').on('submit', function (event) {
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
                    Swal.fire({
                        icon: "success",
                        text: response.message,
                        showCloseButton: true,
                        confirmButtonText: 'Lanjutkan',
                    })
                    document.getElementById('formAddUnit').reset();
                    $('#btnSubmit').removeClass('disabled');
                    $('#createModal').modal('hide');
                    table.ajax.reload();

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
                        if (errors.name) {
                            $('#name').addClass('is-invalid');
                        }
                    }
                }
            })
        })
        let table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('master.types') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'code', name: 'code' },
                { data: 'name', name: 'name' },
                { data: 'desc', name: 'desc' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            language: {
                searchPlaceholder: "Cari Data..."
            }
        });

        $(document).on('click', '.delete-item', function (event) {
            let id = $(this).data('id');
            let name = $(this).data('name');
            var url = '{{ route("master.types.destroy", ":id") }}';
            url = url.replace(':id', id);

            Swal.fire({
                title: 'Peringatan!',
                text: `Apakah anda yakin ingin menghapus Tipe ${name}?`,
                showDenyButton: true,
                confirmButtonText: "Ya, lanjutkan",
                denyButtonText: `Batalkan`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        contentType: 'application/json',
                        processData: false, contentType: false,
                        success: function (response) {
                            Swal.fire({
                                icon: "success",
                                text: response.message,
                                showCloseButton: true,
                                confirmButtonText: 'Oke',
                            })
                            table.ajax.reload();
                        },
                        error: function (xhr, status, error) {
                            Swal.fire({
                                icon: "error",
                                text: xhr.responseJSON.message,
                                showCloseButton: true,
                                confirmButtonText: 'Coba Lagi',
                            });
                        }
                    })
                }
            });
        });

        $('#formEditUnit').on('submit', function (event) {
            event.preventDefault();
            let form = this;
            $('#btnEdit').addClass('disabled');
            $('#nameEdit').removeClass('is-invalid');
            $('#codeEdit').removeClass('is-invalid');
            $.ajax({
                type: 'POST',
                url: $(form).attr('action'),
                data: new FormData(form),
                processData: false,
                contentType: false,
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        text: response.message,
                        showCloseButton: true,
                        confirmButtonText: 'Lanjutkan',
                    });
                    $('#btnEdit').removeClass('disabled');
                    $('#editModal').modal('hide');
                    table.ajax.reload();
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        text: xhr.responseJSON.message,
                        showCloseButton: true,
                        confirmButtonText: 'Coba Lagi',
                    });
                    $('#btnEdit').removeClass('disabled');
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        if (errors.name) {
                            $('#codeEdit').addClass('is-invalid');
                        }
                        if (errors.email) {
                            $('#nameEdit').addClass('is-invalid');
                        }
                    }
                }
            });
        });
    });
    $(document).on('click', '#editUnit', function () {
        let id = $(this).data('id');
        $('#editModal').modal('show');
        $.ajax({
            type: 'GET',
            url: '{{ route("master.types.edit", ":id") }}'.replace(':id', id),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#idEdit').val(response.data.id);
                $('#nameEdit').val(response.data.name);
                $('#codeEdit').val(response.data.code);
                $('#descEdit').val(response.data.desc);
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


</script>
@endsection
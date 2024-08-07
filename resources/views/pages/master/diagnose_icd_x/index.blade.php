@extends('layouts.app', ['title' => 'ICD-X'])

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
                <h5 class="card-title col-sm-10">Master Diagnosa ICD-X</h5>
                <a type="button" class="btn btn-primary btn-sm col-sm-2"
                    href="{{ route('master.diagnose.icd_x.create') }}">+
                    Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3"></div>
                <table class="table table-striped table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Diagnosa</th>
                            <th>Nama (Bahasa Inggris)</th>
                            <th>Nama (Bahasa)</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="card-footer">
                <!-- Optional footer content -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptjs')
<script>
    $(document).ready(function () {
        let table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('master.diagnose.icd_x') }}",
            dom: "<'row'<'col-sm-9 mb-4 gap-2'l><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-9 mt-4'i><'col-sm-3 mt-4'p>>",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'code', name: 'code' },
                { data: 'name_en', name: 'name_en' },
                { data: 'name_id', name: 'name_id' },
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
            var url = '{{ route("master.diagnose.icd_x.destroy", ":id") }}';
            url = url.replace(':id', id);

            Swal.fire({
                title: 'Peringatan!',
                text: `Apakah anda yakin ingin menghapus diagnosa ${name}?`,
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
                            table.ajax.reload();
                        }
                    })
                }
            });
        });
    });
</script>
@endsection
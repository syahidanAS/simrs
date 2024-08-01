@extends('layouts.app', ['title' => 'Master Dokter'])
@section('content')
<div class="app-content my-4">
    <div class="container">
        <div class="row"></div>
        <div class="card table-responsive">
            <div class="card-header">
                <h5 class="card-title col-sm-10">Master Dokter</h5>
                <a type="button" class="btn btn-primary btn-sm col-sm-2" href="{{ route('master.doctors.create') }}">+
                    Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3"></div>
                <table class="table table-striped table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Spesialis</th>
                            <th>Jenis Kelamin</th>
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
            ajax: "{{ route('master.doctors') }}",
            dom: "<'row'<'col-sm-9 mb-4 gap-2'l><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-9 mt-4'i><'col-sm-3 mt-4'p>>",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'specialist', name: 'specialist' },
                { data: 'gender', name: 'gender' },
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
            var url = '{{ route("master.doctors.destroy", ":id") }}';
            url = url.replace(':id', id);

            Swal.fire({
                title: 'Peringatan!',
                text: `Apakah anda yakin ingin menghapus permission ${name}?`,
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
    });
</script>
@endsection
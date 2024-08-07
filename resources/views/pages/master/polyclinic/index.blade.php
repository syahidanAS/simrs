@extends('layouts.app', ['title' => 'Master Poliklinik'])

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
                <h5 class="card-title col-sm-10">Master Poliklinik</h5>
                <a type="button" class="btn btn-primary btn-sm col-sm-2"
                    href="{{ route('master.polyclinics.create') }}">+
                    Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3"></div>
                <table class="table table-striped table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Poli</th>
                            <th>Nama Poli</th>
                            <th>Jam Buka</th>
                            <th>Jam Tutup</th>
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
            ajax: "{{ route('master.polyclinics') }}",
            "dom": '<"top"i>rt<"bottom"lp><"clear">',
            "dom": '<"top"f>rt<"bottom"lp><"clear">',
            "paging": true,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'kd_poli', name: 'kd_poli' },
                { data: 'name', name: 'name' },
                { data: 'open_at', name: 'open_at' },
                { data: 'closed_at', name: 'closed_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            language: {
                searchPlaceholder: "Cari Data..."
            }
        });
    });
    $(document).on('click', '.delete-item', function (event) {
        let id = $(this).data('id');
        let name = $(this).data('name');
        var url = '{{ route("master.polyclinics.destroy", ":id") }}';
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
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
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
</script>
@endsection
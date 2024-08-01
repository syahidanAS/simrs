<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIMRS ARZ || Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('/plugins/css/adminlte.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('/assets/css/main.css') }}">
    <style>
        body {
            background-color: #f0f0f0;
            /* Ganti dengan warna yang diinginkan */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-center my-4">
            <h1 class="text-center">SIMRS ARZ</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" class="form-control" id="email" placeholder="idan@arz.com"
                                    name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="password"
                                    name="password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer py-3 text-secondary">
            <div class="container text-center">
                <p class="mb-0" style="font-size: 12px;">&copy; 2024 ARZ Technology. All rights reserved.</p>
            </div>
        </footer>
    </div>
    <script src="{{ asset('/plugins/js/adminlte.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#loginForm').on('submit', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{route("login-action")}}',
                    data: {
                        email: $('input[name="email"]').val(),
                        password: $('input[name="password"]').val(),
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: "success",
                            text: response.message,
                            showCloseButton: true,
                            confirmButtonText: 'Lanjutkan',
                        })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    window.location.replace('/');
                                }

                            });
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
            })
        })
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta charset="utf-8">
    <title>{{$title}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ARZ SIMRS" />
    <meta property="og:title" content="ARZ SIMRS" />
    <meta property="og:description" content="ARZ SIMRS" />
    <meta property="og:image" content="https:/workload.dexignlab.com/xhtml/social-image.png" />
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png" />
    <link href="{{ asset('/plugins/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/vendor/lightgallery/css/lightgallery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/plugins/vendor/select2/css/select2.min.css') }}">
    <link href="{{ asset('/plugins/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
</head>

<body>
    <div id="main-wrapper">
        @include('layouts.components.navbar')
        @yield('content')
        @include('layouts.components.sidebar')
    </div>
    <script src="{{ asset('/plugins/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('/plugins/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('/plugins/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('/plugins/js/custom.min.js') }}"></script>
    <script src="{{ asset('/plugins/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('/plugins/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/js/plugins-init/datatables.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('/plugins/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('/plugins/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('/plugins/js/plugins-init/select2-init.js') }}"></script>
    @yield('scriptjs')
</body>

</html>
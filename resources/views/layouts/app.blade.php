<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hot News</title>

    <!-- SB Admin 2 CSS -->
    <link href="{{ asset('assets/sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom CSS (optional) -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('layouts.sidebar') {{-- Buat sidebar nanti --}}
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layouts.navbar') {{-- Buat navbar nanti --}}
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- SB Admin 2 JS -->
    <script src="{{ asset('assets/sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/sb-admin-2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/sb-admin-2/js/sb-admin-2.min.js') }}"></script>
</body>
</html>

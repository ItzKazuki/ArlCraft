<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>{{ config('app.name') }} | {{ $title }}</title>

        <link rel="icon" type="image/png" href="/assets/favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="/assets/favicon-16x16.png" sizes="16x16" />

        <!-- Custom fonts for this template-->
        <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="/assets/admin/css/sb-admin-2.min.css" rel="stylesheet">
    </head>
    <body class="bg-gradient-primary">

        <div class="container">
            @yield('content')
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="/assets/admin/js/sb-admin-2.min.js"></script>
        <script src="/vendor/sweetalert2/sweetalert2.all.min.js"></script>
        <script>
            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: '{{ Session::get('error') }}',
                })
            @endif
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    html: '{{ Session::get('success') }}'
                })
            @endif
            @if (Session::has('info'))
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    html: '{{ Session::get('info') }}'
                })
            @endif
        </script>

        {!! NoCaptcha::renderJs() !!}
    </body>
</html>
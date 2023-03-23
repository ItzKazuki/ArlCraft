<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>{{ config('app.name') }} | {{ $title }}</title>

    <link rel="icon" type="image/png" href="{{ asset('/assets/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('/assets/favicon-16x16.png') }}" sizes="16x16" />

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/vendor/fontawesome-free/css/brands.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/assets/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    {{--  summernote --}}
    <link rel="stylesheet" href="{{ asset('/vendor/summernote/summernote-bs4.min.css') }}">

    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('/vendor/select2/css/select2.min.css') }}">

    <style>
        .youtube-container {
	        margin: auto; position: relative; width: 100%; height: 0; padding-bottom: 56.25%;
        }
        @media (min-width: 1000px) {
            .youtube-container {
                margin: auto; position: relative; width: 50%; height: 0; padding-bottom: 28.125%;
            }
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.partials.admin.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layouts.partials.admin.nav')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    @yield('container')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; {{ config('app.name') }} Network | 2020-{{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('layouts.partials.modal.logout')

    <!-- Bootstrap core JavaScript-->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    </script>

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

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/assets/admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('/vendor/summernote/summernote-bs4.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('/vendor/select2/js/select2.min.js') }}"></script>


</body>

</html>
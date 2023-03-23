<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | {{ $title }}</title>

    <meta property="title" content="{{ config('app.name') }} Network">
    <meta property="site_name" content="{{ config('app.url') }}">
    <meta property="description" content="
    Apakah kamu bosan bermain Minecraft hanya sendiri? Ayo Gabung ArlCraft Network klik di sini!
    ">
    <meta property="og:title" content="{{ config('app.name') }} Network">
    <meta property="og:site_name" content="{{ config('app.url') }}">
    <meta property="og:description" content="
    Apakah kamu bosan bermain Minecraft hanya sendiri? Ayo Gabung ArlCraft Network klik di sini!
    ">
    <meta property="og:image" content="{{ asset('/assets/img/arl2.gif') }}" />
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" type="image/png" href="{{ asset('/assets/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('/assets/favicon-16x16.png') }}" sizes="16x16" />

    <!-- Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/css/stylesheet.css') }}">
</head>
<body>

@include('layouts.partials.nav')

@yield('body')

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/js/main.js') }}"></script>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> --}}
</body>
</html>
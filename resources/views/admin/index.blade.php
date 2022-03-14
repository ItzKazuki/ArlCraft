@extends('layouts.admin')
@section('container')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Welcome Back Admin, {{ Auth::user()->name }}</h1>
</div>
@endsection
@extends('layouts.admin')
@section('container')
<div
    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Event</h1>
</div>
<div class="col-lg-8">
    <form method="post" action="{{ route('admin.event.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="event_name" class="form-label">Event Name</label>
          <input type="text" class="form-control @error('event_name') is-invalid @enderror" id="event_name" name="event_name" required autofocus>
          @error('event_name')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" required>
            @error('deskripsi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="link" class="form-label mr-1">Link</label>
            <i data-toggle="popover" data-trigger="hover" data-content="tidak usah menggunakan http, ex: arlcraft.net" class="fas fa-info-circle"></i>
            <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" required>
            @error('link')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="start_at" class="form-label">Start At</label>
            <input type="date" class="form-control @error('start_at') is-invalid @enderror" id="start_at" name="start_at" required>
            @error('start_at')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="end_at" class="form-label">End At</label>
            <input type="date" class="form-control @error('end_at') is-invalid @enderror" id="end_at" name="end_at"required>
            @error('end_at')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Event Img</label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
            <i data-toggle="popover" data-trigger="hover" data-content="jenis file harus berupa jpng atau png, minimal 1mb" class="fas fa-info-circle"></i>
            <input type="file" class="form-control @error('img') is-invalid @enderror" id="img" name="img" onchange="previewImage()">
            @error('img')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mb-5">Submit</button>
    </form>
</div>
@endsection
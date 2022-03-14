@extends('layouts.admin')
@section('container')
<div
    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Videos</h1>
</div>
<div class="col-lg-8">
    <form method="post" action="{{ route('video.store') }}">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" autofocus required>
          @error('title')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
        </div>
        <div class="mb-3">
            <label for="youtube_id" class="form-label">Youtube Video ID</label>
            <input type="text" class="form-control  @error('youtube_id') is-invalid @enderror" value="{{ old('youtube_id') }}" id="youtube_id" name="youtube_id" required>
            @error('youtube_id')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
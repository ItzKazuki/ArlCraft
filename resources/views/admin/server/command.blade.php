@extends('layouts.admin')
@section('container')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Send Commanads to Server</h1>
</div>

<div class="col-lg-8">
  <form method="post" action="{{ route('send.command.index') }}">
      @csrf
      <div class="mb-3">
        <label for="command" class="form-label">Command</label>
        <input type="text" class="form-control @error('command') is-invalid @enderror" id="command" name="command" value="{{ old('command') }}" required autofocus>
        @error('command')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary mb-5">Submit</button>
  </form>
</div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Send Commanad List</h1>
</div>

<div class="table-responsive">
  <table class="table table-striped table-sm">
      <thead>
          <tr>
              <th scope="col">#</th>
              <th scope="col">Command</th>
              <th scope="col">Send By</th>
              <th scope="col">Send At</th>
          </tr>
      </thead>
      {{-- <tbody>
          @foreach ($bans as $ban)
          <tr>
              <td>{{ $ban->id }}</td>
              <td>{{ $ban->username }}</td>
              <td>{{ $ban->duration }}</td>
              <td>{{ $ban->message }}</td>
              <td>{{ $ban->banned_by }}</td>
          </tr>
          @endforeach
      </tbody> --}}
  </table>
</div>
@endsection
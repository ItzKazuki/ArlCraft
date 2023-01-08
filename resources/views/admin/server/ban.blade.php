@extends('layouts.admin')
@section('container')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ban Members</h1>
</div>

<div class="col-lg-8">
    <form method="post" action="{{ route('ban.post') }}">
        @csrf
        {{-- <div class="mb-3">
          <label for="command" class="form-label">Command</label>
          <input type="text" class="form-control @error('command') is-invalid @enderror" id="command" name="command" value="{{ old('command') }}" required autofocus>
          @error('command')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
        </div> --}}
        <div class="mb-3">
            <label for="player" class="form-label">Player</label>
            <input type="text" class="form-control @error('player') is-invalid @enderror" id="player" name="player" value="{{ old('player') }}" required autofocus>
            @error('player')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="durasi" class="form-label mr-1">Durasi</label><i data-toggle="popover" data-trigger="hover" data-content="durasi banned, gunakan 1d, 1m, 1y, kosongkan jika ingin selamanya" class="fas fa-info-circle"></i>
            <input type="text" class="form-control @error('durasi') is-invalid @enderror" id="durasi" name="durasi" value="{{ old('durasi') }}" required autofocus>
            @error('durasi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="message" class="form-label mr-1">Message</label><i data-toggle="popover" data-trigger="hover" data-content="gunakan message ini untuk alasan dari banned" class="fas fa-info-circle"></i>
            <input type="text" class="form-control @error('message') is-invalid @enderror" id="message" name="message" value="{{ old('message') }}" required autofocus>
            @error('message')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mb-5">Submit</button>
    </form>
</div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ban Members list</h1>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Duration</th>
                <th scope="col">Message</th>
                <th scope="col">Banned At</th>
                <th scope="col">Banned By</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bans as $ban)
            <tr>
                <td>{{ $ban->id }}</td>
                <td>{{ $ban->username }}</td>
                <td>{{ $ban->duration }}</td>
                <td>{{ $ban->message }}</td>
                <td>{{ $ban->created_at }}</td>
                <td>{{ $ban->banned_by }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
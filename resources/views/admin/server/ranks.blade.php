@extends('layouts.admin')
@section('container')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">User Ranks</h1>
</div>

<div class="table-responsive col-lg-10">
  <div class="mb-3">
      <a href="{{ route('user.create') }}" class="btn btn-primary btn-icon-split mr-3">
          <span class="icon text-white-50">
              <i class="fas fa-user-plus"></i>
          </span>
          <span class="text">Set New Rank</span>
      </a>
      <a href="{{ route('notifications.index') }}" class="btn btn-info btn-icon-split">
          <span class="icon text-white-50">
              <i class="fas fa-paper-plane"></i>
          </span>
          <span class="text">Add User to Rank</span>
      </a>
  </div>
  <table class="table table-striped table-sm">
      <thead>
          <tr>
              <th scope="col">#</th>
              <th scope="col">Username</th>
              <th scope="col">Ranks</th>
              <th scope="col">Set By</th>
              <th scope="col">Set At</th>
              <th scope="col">Action</th>
          </tr>
      </thead>
      {{-- <tbody>
          @foreach ($users as $user)
          <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->username }}</td>
              <td>{{ $user->email }}</td>
              <td><span class="badge bg-{{ $user->isAdmin ? 'danger' : 'primary' }} text-white">{{ $user->isAdmin ? 'Admin' : 'User' }}</span></td>
              <td>
                  <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                  <form action="{{ route('user.destroy', $user->id) }}" method="post" class="d-inline">
                      @method('delete')
                      @csrf
                      <button class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody> --}}
  </table>
</div>
@endsection
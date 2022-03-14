@extends('layouts.admin')
@section('container')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">My Videos</h1>
</div>

@if (session()->has('success'))
    <div class="card mb-3 border-left-success">
        <div class="card-body">
            {{ session('success') }}
        </div>
    </div>
@endif

<div class="table-responsive col-lg-10">
    <a href="{{ route('video.create') }}" class="btn btn-primary mb-3">Create Video List</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Youtube Id</th>
                <th scope="col">Created By</th>
                <th scope="col">Created At</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($videos as $video)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $video->title }}</td>
                <td>{{ $video->youtube_id }}</td>
                <td>{{ $video->username }}</td>
                <td>{{ $video->created_at }}</td>
                <td>
                    <a href="{{ route('video.show', $video->id) }}" class="btn btn-info btn-circle btn-sm"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('video.edit', $video->id) }}" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('video.destroy', $video->id) }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
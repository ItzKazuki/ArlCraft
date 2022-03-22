@extends('layouts.admin')
@section('container')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">My Events</h1>
</div>

@include('partials.success')

<div class="table-responsive col-lg-10">
    <a href="{{ route('event.create') }}" class="btn btn-primary mb-3">Create Event List</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Event Name</th>
                <th scope="col">Created By</th>
                <th scope="col">Start At</th>
                <th scope="col">End At</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $event->event_name }}</td>
                <td>{{ $event->create_by }}</td>
                <td>{{ $event->start_at }}</td>
                <td>{{ $event->end_at }}</td>
                <td>
                    <a href="{{ route('event.show', $event->id) }}" class="btn btn-info btn-circle btn-sm"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('event.edit', $event->id) }}" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('event.destroy', $event->id) }}" method="post" class="d-inline">
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
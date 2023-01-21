@extends('layouts.index')
@section('body')
<div class="container">

    <div class="row mt-3 mb-2">
        <div class="col">
            <h1 class="text-white">List Event</h1>
        </div>
    </div>

    @if (is_null($events))
        <div class="row">
            <h3 class="text-white">
                Tidak ada event!
            </h3>
        </div>
    @endif
    <div class="row">
        @foreach ($events as $event)
        <div class="col-md-4">
            <div class="card mb-3 bg-transparent border-0">
                @if ($event->img)
                <img src="{{ Storage::path($event->img) }}" alt="Gambar Event" class="card-img-top">
                @endif
                <div class="card-body text-white">
                    <h5 class="card-title">{{ $event->event_name }}</h5>
                    <p class="card-text">{{ $event->deskripsi }}</p>
                    <h5 class="card-title"><i class="bi bi-calendar-event"></i> Start: {{ $event->start_at }}</h5>
                    <h5 class="card-title"><i class="bi bi-calendar-event-fill"></i> End: {{ $event->end_at }}</h5>
                    <a href="{{ $event->link }}" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
        @endforeach
</div>
@endsection
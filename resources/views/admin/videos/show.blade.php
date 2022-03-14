@extends('layouts.admin')
@section('container')
    <div class="container reveal ">

        <a href="{{ route('video.index') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Back to My Video</span>
        </a>
        <a href="{{ route('video.edit', $video->id) }}" class="btn btn-warning btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-edit"></i>
            </span>
            <span class="text">Edit</span>
        </a>
        <form action="{{ route('video.destroy', $video->id) }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-danger btn-icon-split" onclick="return confirm('Are you sure?')">
                <span class="icon text-white-50">
                    <i class="fas fa-trash-alt"></i>
                </span>
                <span class="text">Delete</span>
            </button>
        </form>

        <center>
            <p class="fs-4">{{ $video->title }}</p>
        </center>
        <div class="youtube-container">
            <iframe style="position: absolute; top: 0; left: 0;width:100%;height: 100%;"
             src="https://www.youtube.com/embed/{{ $video->youtube_id }}" title="YouTube video player" frameborder="0"
             allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
             allowfullscreen></iframe>
        </div>
    </div>
@endsection
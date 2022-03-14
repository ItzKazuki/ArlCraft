@extends('layouts.index')
@section('body')
<div class="text-white" style="padding: 2rem 0rem;">
    @foreach ($videos as $video)
    <div class="container reveal">
        <center>
            <p class="fs-4">{{ $video->title }}</p>
        </center>
        <div class="youtube-container">
            <iframe style="position: absolute; top: 0; left: 0;width:100%;height: 100%;"
             src="https://www.youtube.com/embed/{{ $video->youtube_id }}" title="YouTube video player" frameborder="0"
             allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
             allowfullscreen></iframe>
        </div>
        <hr>
    </div>  
    @endforeach
</div>
@endsection
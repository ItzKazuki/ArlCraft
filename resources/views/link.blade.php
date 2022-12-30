@extends('layouts.index')
@section('body')
<div class="text-white" style="padding: 2rem 0rem;">
    @foreach ($links as $link)
    <div class="container reveal">
        <p class="fs-4">{{ $link->name }}</p>
        <div class="youtube-container">
            <a href="{{ $link->link }}">here!</a>
        </div>
        <hr>
    </div>  
    @endforeach
</div>
@endsection
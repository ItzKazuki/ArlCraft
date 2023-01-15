<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.videos.index', [
            'title' => 'My Videos',
            'videos' => Video::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videos.create', [
            'title' => 'Create Video'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'youtube_id' => 'required|unique:videos'
        ]);

        $validatedData['username'] = Auth::user()->username;

        Video::create($validatedData);

        return redirect()->route('admin.video.index')->with('success', 'Video Berhasil di tambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return view('admin.videos.show', [
            'title' => 'Show',
            'video' => $video
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('admin.videos.edit', [
            'title' => 'Edit Video',
            'video' => $video
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $validatedData = $request->validate([
            'title'      => 'required|max:255',
            'youtube_id' => 'required|unique:videos,youtube_id,' . $video->id
        ]);

        $validatedData['username'] = Auth::user()->username;

        $video->update($validatedData);

        return redirect()->route('admin.video.index')->with('success', 'Video Berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->destroy($video->id);

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil di hapus!');
    }
}

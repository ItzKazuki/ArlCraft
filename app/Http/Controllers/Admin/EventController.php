<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.event.index', [
            'title' => 'Events',
            'events' => Event::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create', [
            'title' => 'Create Event'
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
        $validation = $request->validate([
            'event_name' => 'required|min:3|max:255|unique:events,event_name',
            'deskripsi' =>  'required|min:3|max:255',
            'link' =>  'required',
            'start_at' => 'required|date',
            'end_at' => 'required|date'
        ]);

        $validation['create_by'] = Auth::user()->name;

        Event::create($validation);

        return redirect()->route('event.index')->with('success', 'Event berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.event.edit', [
            'title' => 'Edit Event',
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $validation = $request->validate([
            'event_name' => 'required|min:3|max:255|unique:events,event_name,' . $event->id,
            'deskripsi' =>  'required|min:3|max:255',
            'link' =>  'required',
            'start_at' => 'required|date',
            'end_at' => 'required|date'
        ]);

        $validation['create_by'] = Auth::user()->name;

        $event->update($validation);

        return redirect()->route('event.index')->with('success', 'Event berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->destroy($event->id);

        return redirect()->route('event.index')->with('success', 'Event berhasil di hapus!');
    }
}

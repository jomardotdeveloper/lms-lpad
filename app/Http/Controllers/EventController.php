<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Notification;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $event = Event::create($request->all());
        Notification::create([
            'name' => $event->name . ' has been created',
            'link' => route('events.index'),
        ]);
        $this->createLog('Event created', auth()->user(), true);
        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $event->update($request->all());
        Notification::create([
            'name' => $event->name . ' has been updated',
            'link' => route('events.index'),
        ]);
        $this->createLog('Event updated', auth()->user(), true);
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        Notification::create([
            'name' => $event->name . ' has been deleted',
            'link' => route('events.index'),
        ]);
        $this->createLog('Event deleted', auth()->user(), true);
    }
}

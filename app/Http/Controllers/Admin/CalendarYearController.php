<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalendarYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CalendarYearController extends Controller
{
    /**
     * Display a listing of calendar events.
     */
    public function index()
    {
        $events = CalendarYear::orderBy('event_date', 'asc')->get();

        return view('admin.calendar.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('admin.calendar.create');
    }

    /**
     * Store a newly created event.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'event_date'  => 'required|date',
            'description' => 'nullable|string',
            'link'        => 'nullable|string|max:255',
            'image'       => 'nullable|image|max:2048',
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('calendar_images', 'public');
        }

        CalendarYear::create([
            'title'       => $request->title,
            'event_date'  => $request->event_date,
            'description' => $request->description,
            'link'        => $request->link,
            'image'       => $image,
        ]);

        return redirect()->route('admin.calendar.index')
                         ->with('success', 'Event added successfully.');
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit($id)
    {
        $event = CalendarYear::findOrFail($id);

        return view('admin.calendar.edit', compact('event'));
    }

    /**
     * Update the specified event.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'event_date'  => 'required|date',
            'description' => 'nullable|string',
            'link'        => 'nullable|string|max:255',
            'image'       => 'nullable|image|max:2048',
        ]);

        $event = CalendarYear::findOrFail($id);

        $image = $event->image;
        if ($request->hasFile('image')) {

            // Delete old image
            if ($image && Storage::disk('public')->exists($image)) {
                Storage::disk('public')->delete($image);
            }

            // Store new one
            $image = $request->file('image')->store('calendar_images', 'public');
        }

        $event->update([
            'title'       => $request->title,
            'event_date'  => $request->event_date,
            'description' => $request->description,
            'link'        => $request->link,
            'image'       => $image,
        ]);

        return redirect()->route('admin.calendar.index')
                         ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified event.
     */
    public function destroy($id)
    {
        $event = CalendarYear::findOrFail($id);

        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('admin.calendar.index')
                         ->with('success', 'Event deleted successfully.');
    }

    /**
     * Fetch events for a specific date (AJAX).
     */
    public function getEventsByDate(Request $request)
    {
        $request->validate(['date' => 'required|date']);

        $events = CalendarYear::where('event_date', $request->date)
                              ->orderBy('id', 'desc')
                              ->get();

        return response()->json($events);
    }
}

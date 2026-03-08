<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\TimeSlot;
use Illuminate\Http\Request;

class TimeSlotController extends Controller
{
    public function create(Event $event)
    {
        return view('time-slots.create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'capacity' => 'required|integer|min:1',
        ]);

        $validated['event_id'] = $event->id;
        TimeSlot::create($validated);

        return redirect()->route('events.show', $event->id)
            ->with('success', 'Time slot added successfully');
    }

    public function edit(TimeSlot $timeSlot)
    {
        return view('time-slots.edit', compact('timeSlot'));
    }

    public function update(Request $request, TimeSlot $timeSlot)
    {
        $validated = $request->validate([
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'capacity' => 'required|integer|min:1',
        ]);

        $timeSlot->update($validated);
        return redirect()->route('events.show', $timeSlot->event_id)
            ->with('success', 'Time slot updated successfully');
    }

    public function destroy(TimeSlot $timeSlot)
    {
        $eventId = $timeSlot->event_id;
        $timeSlot->delete();
        return redirect()->route('events.show', $eventId)
            ->with('success', 'Time slot deleted successfully');
    }
}

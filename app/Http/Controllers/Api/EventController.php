<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('status', 'active')
            ->with(['companies', 'timeSlots'])
            ->get();
        
        return response()->json($events);
    }

    public function show($id)
    {
        $event = Event::with(['companies', 'timeSlots', 'applicants'])
            ->findOrFail($id);
        
        return response()->json($event);
    }
}

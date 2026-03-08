<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApplicantController extends Controller
{
    public function store(Request $request, $eventId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:applicants,email',
            'phone' => 'required|string',
            'education' => 'required|string',
            'experience' => 'nullable|string',
            'skills' => 'nullable|string',
            'time_slot_id' => 'required|exists:time_slots,id'
        ]);

        $qrCode = 'JOBFAIR-' . strtoupper(Str::random(10));

        $applicant = Applicant::create([
            'event_id' => $eventId,
            'time_slot_id' => $request->time_slot_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'education' => $request->education,
            'experience' => $request->experience,
            'skills' => $request->skills,
            'qr_code' => $qrCode
        ]);

        TimeSlot::find($request->time_slot_id)->increment('registered_count');

        return response()->json([
            'message' => 'Registration successful',
            'applicant' => $applicant,
            'qr_code' => $qrCode
        ], 201);
    }

    public function lookup($qrCode)
    {
        $applicant = Applicant::where('qr_code', $qrCode)->first();

        if (!$applicant) {
            return response()->json(['error' => 'Applicant not found'], 404);
        }

        return response()->json($applicant);
    }
}

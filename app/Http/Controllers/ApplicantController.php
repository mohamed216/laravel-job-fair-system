<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Event;
use App\Models\TimeSlot;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApplicantController extends Controller
{
    public function register(Event $event)
    {
        $timeSlots = $event->timeSlots()->whereColumn('registered_count', '<', 'capacity')->get();
        return view('applicants.register', compact('event', 'timeSlots'));
    }

    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'time_slot_id' => 'required|exists:time_slots,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:applicants,email',
            'phone' => 'required|string',
            'education' => 'required|string',
            'experience' => 'nullable|string',
            'skills' => 'nullable|string',
        ]);

        $qrCode = 'JOBFAIR-' . strtoupper(Str::random(10));
        
        $validated['event_id'] = $event->id;
        $validated['qr_code'] = $qrCode;
        
        $applicant = Applicant::create($validated);

        // Update time slot count
        $timeSlot = TimeSlot::find($validated['time_slot_id']);
        $timeSlot->increment('registered_count');

        return redirect()->route('applicant.qrcode', [$event->id, $applicant->id])
            ->with('success', 'Registration successful!');
    }

    public function showQrCode(Event $event, Applicant $applicant)
    {
        // Generate QR code
        $qrCode = new QrCode(
            data: $applicant->qr_code,
            encoding: new Encoding('UTF-8'),
            size: 300,
            margin: 10,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255)
        );

        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        $qrImage = base64_encode($result->getString());

        return view('applicants.qrcode', compact('applicant', 'qrImage', 'event'));
    }

    public function searchByQr(Request $request)
    {
        $qrCode = $request->get('qr_code');
        $applicant = Applicant::where('qr_code', $qrCode)->first();

        if (!$applicant) {
            return back()->with('error', 'Applicant not found');
        }

        return view('applicants.show', compact('applicant'));
    }

    public function scanQr(Request $request)
    {
        return view('applicants.scan');
    }
}

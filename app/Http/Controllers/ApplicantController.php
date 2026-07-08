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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
            'time_slot_id' => [
                'required',
                Rule::exists('time_slots', 'id')->where('event_id', $event->id),
            ],
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:applicants,email',
            'phone' => 'required|string',
            'education' => 'required|string',
            'experience' => 'nullable|string',
            'skills' => 'nullable|string',
        ]);

        try {
            $applicant = DB::transaction(function () use ($validated, $event) {
                // Lock the time slot row to prevent race conditions on capacity.
                $timeSlot = TimeSlot::where('id', $validated['time_slot_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($timeSlot->registered_count >= $timeSlot->capacity) {
                    throw new \RuntimeException('This time slot is full. Please choose another one.');
                }

                // Generate a guaranteed-unique QR code.
                do {
                    $qrCode = 'JOBFAIR-' . strtoupper(Str::random(10));
                } while (Applicant::where('qr_code', $qrCode)->exists());

                $validated['event_id'] = $event->id;
                $validated['qr_code'] = $qrCode;

                $applicant = Applicant::create($validated);
                $timeSlot->increment('registered_count');

                return $applicant;
            });
        } catch (\RuntimeException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        } catch (\Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Registration failed. Please try again.');
        }

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
        $validated = $request->validate([
            'qr_code' => 'required|string',
        ]);

        $applicant = Applicant::where('qr_code', $validated['qr_code'])->first();

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

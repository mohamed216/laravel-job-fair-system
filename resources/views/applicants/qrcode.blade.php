@extends('layouts.app')
@section('title', 'Your QR Code')
@section('content')
<div class="text-center mt-5">
    <div class="card d-inline-block">
        <div class="card-body">
            <h3>Registration Successful!</h3>
            <p class="text-muted">Save this QR code - you will need it at the event</p>
            
            <div class="my-4">
                <img src="data:image/png;base64,{{ $qrImage }}" alt="QR Code" class="img-fluid">
            </div>
            
            <p><strong>Name:</strong> {{ $applicant->name }}</p>
            <p><strong>Event:</strong> {{ $event->name }}</p>
            <p><strong>Time Slot:</strong> {{ $applicant->timeSlot->start_time }} - {{ $applicant->timeSlot->end_time }}</p>
            <p><strong>QR Code:</strong> <code>{{ $applicant->qr_code }}</code></p>
            
            <div class="mt-4">
                <a href="{{ route('home') }}" class="btn btn-secondary">Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection

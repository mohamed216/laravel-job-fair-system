@extends('layouts.app')

@section('title', $event->name)

@section('content')
<div class="row mt-4">
    <div class="col-md-12">
        <h2>{{ $event->name }}</h2>
        <p>{{ $event->description }}</p>
        
        <div class="row mt-3">
            <div class="col-md-4">
                <p><i class="fas fa-calendar"></i> {{ $event->event_date }}</p>
            </div>
            <div class="col-md-4">
                <p><i class="fas fa-clock"></i> {{ $event->start_time }} - {{ $event->end_time }}</p>
            </div>
            <div class="col-md-4">
                <p><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</p>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('time-slots.create', $event->id) }}" class="btn btn-primary">Add Time Slots</a>
            <a href="{{ route('events.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Time Slots</h5>
            </div>
            <div class="card-body">
                @forelse($event->timeSlots as $slot)
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>{{ $slot->start_time }} - {{ $slot->end_time }}</span>
                    <span>{{ $slot->registered_count }}/{{ $slot->capacity }}</span>
                    <div>
                        <a href="{{ route('time-slots.edit', $slot->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form method="POST" action="{{ route('time-slots.destroy', $slot->id) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </div>
                </div>
                @empty
                <p>No time slots created</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Companies ({{ $event->companies->count() }})</h5>
            </div>
            <div class="card-body">
                @forelse($event->companies as $company)
                <div class="mb-2">
                    <strong>{{ $company->name }}</strong>
                    <br><small>{{ $company->booth_number }}</small>
                </div>
                @empty
                <p>No companies registered</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Applicants ({{ $event->applicants->count() }})</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Time Slot</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($event->applicants as $applicant)
                        <tr>
                            <td>{{ $applicant->name }}</td>
                            <td>{{ $applicant->email }}</td>
                            <td>{{ $applicant->phone }}</td>
                            <td>{{ $applicant->timeSlot->start_time }}</td>
                            <td>{{ $applicant->status }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5">No applicants yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

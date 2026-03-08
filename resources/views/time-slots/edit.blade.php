@extends('layouts.app')
@section('title', 'Edit Time Slot')
@section('content')
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h4>Edit Time Slot</h4></div>
            <div class="card-body">
                <form method="POST" action="{{ route('time-slots.update', $timeSlot->id) }}">
                    @csrf @method('PUT')
                    <div class="mb-3"><label>Start Time</label><input type="time" name="start_time" class="form-control" value="{{ $timeSlot->start_time }}" required></div>
                    <div class="mb-3"><label>End Time</label><input type="time" name="end_time" class="form-control" value="{{ $timeSlot->end_time }}" required></div>
                    <div class="mb-3"><label>Capacity</label><input type="number" name="capacity" class="form-control" value="{{ $timeSlot->capacity }}" required min="1"></div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('events.show', $timeSlot->event_id) }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Add Time Slot')
@section('content')
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h4>Add Time Slot - {{ $event->name }}</h4></div>
            <div class="card-body">
                <form method="POST" action="{{ route('time-slots.store', $event->id) }}">
                    @csrf
                    <div class="mb-3"><label>Start Time</label><input type="time" name="start_time" class="form-control" required></div>
                    <div class="mb-3"><label>End Time</label><input type="time" name="end_time" class="form-control" required></div>
                    <div class="mb-3"><label>Capacity</label><input type="number" name="capacity" class="form-control" required min="1"></div>
                    <button type="submit" class="btn btn-primary">Add</button>
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

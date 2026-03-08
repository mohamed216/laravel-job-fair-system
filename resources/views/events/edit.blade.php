@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
<div class="row mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Edit Event</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('events.update', $event->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Event Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $event->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ $event->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Event Date</label>
                        <input type="date" name="event_date" class="form-control" value="{{ $event->event_date }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control" value="{{ $event->location }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Start Time</label>
                                <input type="time" name="start_time" class="form-control" value="{{ $event->start_time }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>End Time</label>
                                <input type="time" name="end_time" class="form-control" value="{{ $event->end_time }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select" required>
                            <option value="inactive" {{ $event->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="active" {{ $event->status === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ $event->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Event</button>
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

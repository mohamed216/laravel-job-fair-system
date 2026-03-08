@extends('layouts.app')

@section('title', 'Events')

@section('content')
<div class="d-flex justify-content-between align-items-center mt-4">
    <h2>Events</h2>
    <a href="{{ route('events.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Create Event
    </a>
</div>

<div class="mt-4">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Location</th>
                <th>Time</th>
                <th>Companies</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ $event->event_date }}</td>
                <td>{{ $event->location }}</td>
                <td>{{ $event->start_time }} - {{ $event->end_time }}</td>
                <td>{{ $event->companies->count() }}</td>
                <td>
                    <span class="badge bg-{{ $event->status === 'active' ? 'success' : 'secondary' }}">
                        {{ $event->status }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form method="POST" action="{{ route('events.destroy', $event->id) }}" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this event?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

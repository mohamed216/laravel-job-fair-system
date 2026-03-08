@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row mt-4">
    <div class="col-md-12">
        <h2>Admin Dashboard</h2>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h3>{{ $stats['total_events'] }}</h3>
                <p>Total Events</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h3>{{ $stats['active_events'] }}</h3>
                <p>Active Events</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h3>{{ $stats['total_companies'] }}</h3>
                <p>Companies</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h3>{{ $stats['total_applicants'] }}</h3>
                <p>Applicants</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Recent Events</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Companies</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr>
                            <td><a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a></td>
                            <td>{{ $event->event_date }}</td>
                            <td>{{ $event->companies->count() }}</td>
                            <td><span class="badge bg-{{ $event->status === 'active' ? 'success' : 'secondary' }}">{{ $event->status }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Recent Applicants</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Event</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentApplicants as $applicant)
                        <tr>
                            <td>{{ $applicant->name }}</td>
                            <td>{{ $applicant->email }}</td>
                            <td>{{ $applicant->event->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <a href="{{ route('events.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Event
        </a>
        <a href="{{ route('companies.index') }}" class="btn btn-success">
            <i class="fas fa-building"></i> Manage Companies
        </a>
    </div>
</div>
@endsection

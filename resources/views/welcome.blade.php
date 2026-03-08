@extends('layouts.app')

@section('title', 'Job Fair Events')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4">Job Fair Events</h1>
        <p class="lead">Find your dream job at our upcoming recruitment events</p>
    </div>

    @forelse($events as $event)
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h3>{{ $event->name }}</h3>
                    <p class="text-muted">{{ $event->description }}</p>
                    <p><i class="fas fa-calendar"></i> {{ $event->event_date }} | 
                       <i class="fas fa-clock"></i> {{ $event->start_time }} - {{ $event->end_time }} |
                       <i class="fas fa-map-marker-alt"></i> {{ $event->location }}</p>
                    <p><i class="fas fa-building"></i> {{ $event->companies->count() }} Companies Participating</p>
                </div>
                <div class="col-md-4 text-end">
                    @if($event->status === 'active')
                        <a href="{{ route('applicant.register', $event->id) }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus"></i> Register Now
                        </a>
                    @else
                        <span class="badge bg-secondary">Event {{ $event->status }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-info">No active events at the moment. Check back later!</div>
    @endforelse
</div>
@endsection

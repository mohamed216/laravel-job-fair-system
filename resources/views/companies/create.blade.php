@extends('layouts.app')

@section('title', 'Add Company')

@section('content')
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h4>Add Company</h4></div>
            <div class="card-body">
                <form method="POST" action="{{ route('companies.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label>Event</label>
                        <select name="event_id" class="form-select" required>
                            @foreach($events as $event)
                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Company Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Contact Email</label>
                        <input type="email" name="contact_email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Contact Phone</label>
                        <input type="text" name="contact_phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Booth Number</label>
                        <input type="text" name="booth_number" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Company</button>
                    <a href="{{ route('companies.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Edit Company')
@section('content')
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h4>Edit Company</h4></div>
            <div class="card-body">
                <form method="POST" action="{{ route('companies.update', $company->id) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label>Event</label>
                        <select name="event_id" class="form-select" required>
                            @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ $company->event_id == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" value="{{ $company->name }}" required></div>
                    <div class="mb-3"><label>Description</label><textarea name="description" class="form-control">{{ $company->description }}</textarea></div>
                    <div class="mb-3"><label>Email</label><input type="email" name="contact_email" class="form-control" value="{{ $company->contact_email }}" required></div>
                    <div class="mb-3"><label>Phone</label><input type="text" name="contact_phone" class="form-control" value="{{ $company->contact_phone }}"></div>
                    <div class="mb-3"><label>Booth</label><input type="text" name="booth_number" class="form-control" value="{{ $company->booth_number }}"></div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('companies.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

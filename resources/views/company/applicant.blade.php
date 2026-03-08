@extends('layouts.app')
@section('title', $applicant->name)
@section('content')
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h4>Applicant Details</h4></div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $applicant->name }}</p>
                <p><strong>Email:</strong> {{ $applicant->email }}</p>
                <p><strong>Phone:</strong> {{ $applicant->phone }}</p>
                <p><strong>Education:</strong> {{ $applicant->education }}</p>
                <p><strong>Experience:</strong> {{ $applicant->experience }}</p>
                <p><strong>Skills:</strong> {{ $applicant->skills }}</p>
                <a href="{{ route('company.scan') }}" class="btn btn-secondary">Scan Another</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h4>Save Notes</h4></div>
            <div class="card-body">
                <form method="POST" action="{{ route('company.saveNote', $applicant->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="viewed">Viewed</option>
                            <option value="shortlisted">Shortlist</option>
                            <option value="rejected">Reject</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Notes</label>
                        <textarea name="notes" class="form-control" rows="4" placeholder="Add notes about this applicant"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

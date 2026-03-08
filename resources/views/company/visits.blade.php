@extends('layouts.app')
@section('title', 'My Visits')
@section('content')
<div class="mt-4">
    <h2>Scanned Applicants</h2>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($visits as $visit)
            <tr>
                <td>{{ $visit->applicant->name }}</td>
                <td>{{ $visit->visited_at }}</td>
                <td><span class="badge bg-{{ $visit->status == 'shortlisted' ? 'success' : ($visit->status == 'rejected' ? 'danger' : 'info') }}">{{ $visit->status }}</span></td>
                <td><a href="{{ route('company.lookup', ['qr_code' => $visit->applicant->qr_code]) }}" class="btn btn-sm btn-info">View</a></td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center">No visits yet</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Company Dashboard')

@section('content')
<div class="row mt-4">
    <div class="col-md-12">
        <h2>Welcome, {{ $company->name }}</h2>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h3>{{ $stats['total_visits'] }}</h3>
                <p>Total Scans</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h3>{{ $stats['shortlisted'] }}</h3>
                <p>Shortlisted</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h3>{{ $stats['rejected'] }}</h3>
                <p>Rejected</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Recent Scans</h5>
                <a href="{{ route('company.scan') }}" class="btn btn-primary">
                    <i class="fas fa-qrcode"></i> Scan QR
                </a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Applicant</th>
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
                            <td>
                                <span class="badge bg-{{ $visit->status === 'shortlisted' ? 'success' : ($visit->status === 'rejected' ? 'danger' : 'info') }}">
                                    {{ $visit->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('company.lookup', ['qr_code' => $visit->applicant->qr_code]) }}" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No scans yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Scan QR Code')
@section('content')
<div class="row mt-4 justify-content-center">
    <div class="col-md-6 text-center">
        <div class="card">
            <div class="card-header"><h4>Scan Applicant QR Code</h4></div>
            <div class="card-body">
                <form method="POST" action="{{ route('company.lookup') }}">
                    @csrf
                    <div class="mb-3">
                        <label>Enter QR Code</label>
                        <input type="text" name="qr_code" class="form-control" placeholder="Enter QR code or scan" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Lookup Applicant</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

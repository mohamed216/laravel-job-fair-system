@extends('layouts.app')
@section('title', $applicant->name)
@section('content')
<div class="mt-4">
    <h2>{{ $applicant->name }}</h2>
    <p><strong>Email:</strong> {{ $applicant->email }}</p>
    <p><strong>Phone:</strong> {{ $applicant->phone }}</p>
    <p><strong>Education:</strong> {{ $applicant->education }}</p>
    <p><strong>Experience:</strong> {{ $applicant->experience }}</p>
    <p><strong>Skills:</strong> {{ $applicant->skills }}</p>
    <p><strong>Status:</strong> {{ $applicant->status }}</p>
    <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
</div>
@endsection

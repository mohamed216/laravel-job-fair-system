@extends('layouts.app')
@section('title', $company->name)
@section('content')
<div class="mt-4">
    <h2>{{ $company->name }}</h2>
    <p>{{ $company->description }}</p>
    <p><strong>Event:</strong> {{ $company->event->name }}</p>
    <p><strong>Email:</strong> {{ $company->contact_email }}</p>
    <p><strong>Phone:</strong> {{ $company->contact_phone }}</p>
    <p><strong>Booth:</strong> {{ $company->booth_number }}</p>
    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection

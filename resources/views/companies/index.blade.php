@extends('layouts.app')

@section('title', 'Companies')

@section('content')
<div class="d-flex justify-content-between mt-4">
    <h2>Companies</h2>
    <a href="{{ route('companies.create') }}" class="btn btn-primary">Add Company</a>
</div>

<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>Name</th>
            <th>Event</th>
            <th>Email</th>
            <th>Booth</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($companies as $company)
        <tr>
            <td>{{ $company->name }}</td>
            <td>{{ $company->event->name }}</td>
            <td>{{ $company->contact_email }}</td>
            <td>{{ $company->booth_number }}</td>
            <td>
                <a href="{{ route('companies.show', $company->id) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form method="POST" action="{{ route('companies.destroy', $company->id) }}" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

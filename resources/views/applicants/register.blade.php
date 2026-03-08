@extends('layouts.app')
@section('title', 'Register for ' . $event->name)
@section('content')
<div class="row mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h4>Register for {{ $event->name }}</h4></div>
            <div class="card-body">
                <form method="POST" action="{{ route('applicant.store', $event->id) }}">
                    @csrf
                    <div class="mb-3"><label>Full Name</label><input type="text" name="name" class="form-control" required></div>
                    <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                    <div class="mb-3"><label>Phone</label><input type="text" name="phone" class="form-control" required></div>
                    <div class="mb-3"><label>Education</label><input type="text" name="education" class="form-control" placeholder="e.g., BSc Computer Science" required></div>
                    <div class="mb-3"><label>Experience</label><textarea name="experience" class="form-control" rows="3" placeholder="Your work experience"></textarea></div>
                    <div class="mb-3"><label>Skills</label><input type="text" name="skills" class="form-control" placeholder="e.g., PHP, Laravel, Flutter"></div>
                    <div class="mb-3">
                        <label>Preferred Time Slot</label>
                        <select name="time_slot_id" class="form-select" required>
                            @foreach($timeSlots as $slot)
                            <option value="{{ $slot->id }}">{{ $slot->start_time }} - {{ $slot->end_time }} ({{ $slot->capacity - $slot->registered_count }} slots left)</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

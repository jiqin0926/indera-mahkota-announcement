@extends('layouts.app')
@section('title', 'Edit Feedback')

@section('content')
<h2>Edit Feedback</h2>
<form action="{{ route('feedback.update', $feedback) }}" method="POST">
    @csrf @method('PUT')
    <textarea name="message" class="form-control mb-2" rows="4" maxlength="1000" required>{{ old('message', $feedback->message) }}</textarea>
    <button class="btn btn-warning">Update</button>
    <a href="{{ route('announcements.show', $feedback->announcement_id) }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
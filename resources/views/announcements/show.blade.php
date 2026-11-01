@extends('layouts.app')
@section('title', $announcement->title)

@section('content')
<a href="{{ route('announcements.index') }}" class="btn btn-sm btn-secondary mb-3">&larr; Back</a>

<h2>{{ $announcement->title }}</h2>
<p>
    <span class="badge bg-secondary">{{ $announcement->category->name }}</span>
    <span class="badge bg-info text-dark">{{ ucfirst($announcement->priority) }}</span>
    <small class="text-muted">{{ $announcement->publish_date }} &middot; by {{ $announcement->user->name }}</small>
</p>
<p style="white-space: pre-line">{{ $announcement->body }}</p>

<hr>
<h5>Feedback</h5>

@forelse($announcement->feedback as $f)
    <div class="border rounded p-2 mb-2">
        <strong>{{ $f->user->name }}</strong>
        <small class="text-muted">{{ $f->created_at->diffForHumans() }}</small>
        <p class="mb-1">{{ $f->message }}</p>
        @if(session('user_id') == $f->user_id || session('user_role') === 'admin')
            <a href="{{ route('feedback.edit', $f) }}" class="btn btn-sm btn-outline-warning">Edit</a>
            <form action="{{ route('feedback.destroy', $f) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Delete this feedback?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
        @endif
    </div>
@empty
    <p class="text-muted">No feedback yet.</p>
@endforelse

@if(session('user_id'))
    <form action="{{ route('feedback.store', $announcement) }}" method="POST" class="mt-3">
        @csrf
        <textarea name="message" class="form-control mb-2" rows="3" placeholder="Write your feedback..." required></textarea>
        <button class="btn btn-primary">Submit Feedback</button>
    </form>
@else
    <p><a href="{{ route('login.show') }}">Login</a> to leave feedback.</p>
@endif
@endsection
@extends('layouts.app')
@section('title', 'Announcements')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Announcements</h2>
    @if(session('user_role') === 'admin')
        <a href="{{ route('announcements.create') }}" class="btn btn-success">+ New Announcement</a>
    @endif
</div>

<form method="GET" action="{{ route('announcements.index') }}" class="row g-2 mb-4">
    <div class="col-md-5">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search title...">
    </div>
    <div class="col-md-3">
        <select name="category" class="form-select">
            <option value="">All categories</option>
            @foreach($categories as $c)
                <option value="{{ $c->id }}" @selected(request('category') == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <select name="priority" class="form-select">
            <option value="">All priority</option>
            @foreach(['normal','important','urgent'] as $p)
                <option value="{{ $p }}" @selected(request('priority') == $p)>{{ ucfirst($p) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary w-100">Search</button>
    </div>
</form>

<div class="row">
    @forelse($announcements as $a)
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <span class="badge bg-secondary">{{ $a->category->name }}</span>
                    <span class="badge {{ $a->priority == 'urgent' ? 'bg-danger' : ($a->priority == 'important' ? 'bg-warning text-dark' : 'bg-info text-dark') }}">
                        {{ ucfirst($a->priority) }}
                    </span>
                    <h5 class="card-title mt-2">{{ $a->title }}</h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($a->body, 100) }}</p>
                    <small class="text-muted">{{ $a->publish_date }} &middot; by {{ $a->user->name }}</small>
                </div>
                <div class="card-footer bg-white">
                    <a href="{{ route('announcements.show', $a) }}" class="btn btn-sm btn-outline-primary">Read</a>
                    @if(session('user_role') === 'admin')
                        <a href="{{ route('announcements.edit', $a) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                        <form action="{{ route('announcements.destroy', $a) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this announcement?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">No announcements found.</p>
    @endforelse
</div>

{{ $announcements->links('pagination::bootstrap-5') }}
@endsection
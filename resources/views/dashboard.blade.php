@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <h2>Dashboard</h2>
    <p>Welcome, <strong>{{ session('user_name') }}</strong> ({{ session('user_role') }}).</p>

    <a href="{{ route('announcements.index') }}" class="btn btn-primary">View Announcements</a>

    @if(session('user_role') === 'admin')
        <a href="{{ route('announcements.create') }}" class="btn btn-success">New Announcement</a>
    @endif
@endsection
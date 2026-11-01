@extends('layouts.app')
@section('title', 'New Announcement')

@section('content')
<h2>New Announcement</h2>
<form action="{{ route('announcements.store') }}" method="POST">
    @csrf
    @include('announcements._form', ['announcement' => null])
    <button class="btn btn-success">Post Announcement</button>
    <a href="{{ route('announcements.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
@extends('layouts.app')
@section('title', 'Edit Announcement')

@section('content')
<h2>Edit Announcement</h2>
<form action="{{ route('announcements.update', $announcement) }}" method="POST">
    @csrf @method('PUT')
    @include('announcements._form')
    <button class="btn btn-warning">Update</button>
    <a href="{{ route('announcements.show', $announcement) }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
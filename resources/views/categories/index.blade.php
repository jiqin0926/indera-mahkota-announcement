@extends('layouts.app')
@section('title', 'Categories')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Categories</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-success">+ New Category</a>
</div>
<table class="table table-bordered">
    <thead><tr><th>Name</th><th>Announcements</th><th width="180">Action</th></tr></thead>
    <tbody>
    @foreach($categories as $c)
        <tr>
            <td>{{ $c->name }}</td>
            <td>{{ $c->announcements_count }}</td>
            <td>
                <a href="{{ route('categories.edit', $c) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                <form action="{{ route('categories.destroy', $c) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Delete this category and its announcements?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
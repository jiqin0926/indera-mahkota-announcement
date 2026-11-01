@extends('layouts.app')
@section('title', 'Edit Category')

@section('content')
<h2>Edit Category</h2>
<form action="{{ route('categories.update', $category) }}" method="POST">
    @csrf @method('PUT')
    @include('categories._form')
    <button class="btn btn-warning">Update</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
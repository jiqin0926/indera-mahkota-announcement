@extends('layouts.app')
@section('title', 'New Category')

@section('content')
<h2>New Category</h2>
<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    @include('categories._form', ['category' => null])
    <button class="btn btn-success">Save</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
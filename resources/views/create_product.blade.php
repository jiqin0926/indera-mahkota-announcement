@extends('layouts.app')
@section('content')
    <h1>Add New Product</h1>
    <form method="POST" action="{{ route('products.store') }}">
        @csrf
        <label>Product Name:</label><br>
        <input type="text" name="name"><br><br>

        <label>Price:</label><br>
        <input type="text" name="price"><br><br>

        <button type="submit">Save</button>
    </form>
@endsection
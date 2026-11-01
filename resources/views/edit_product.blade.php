@extends('layouts.app')
@section('content')
    <h1>Edit Product</h1>
    
    <form method="POST" action="{{ route('products.update', $product) }}">
        @csrf
        @method('PUT')

        <label>Name:</label><br>
        <input type="text" name="name" value="{{ $product->name }}"><br><br>

        <label>Price:</label><br>
        <input type="text" name="price" value="{{ $product->price }}"><br><br>
        
        <button type="submit">Update</button>
    </form>
@endsection
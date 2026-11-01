@extends('layouts.app')
@section('content')
    <h1>Product List</h1>

    @if($products->isEmpty())
        <p>No products available.</p>
    @else
        <ul>
        @foreach($products as $product)
            <li>
                <strong>{{ $product->name }}</strong> — RM{{ $product->price }}
                <a href="{{ route('products.edit', $product) }}">Edit</a>
            </li>

            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
            </form>

        @endforeach
        </ul>
    @endif
@endsection
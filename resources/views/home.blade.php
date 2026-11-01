@extends('layouts.app')
@section('content')

    <h1>Welcome Page</h1>

    <p>Hello, {{ $username }}!</p>

@if($username == 'Jiqin')

    <p>You are logged in as admin.</p>

@elseif($username == 'Guest')

    <p>You are a guest user.</p>

@else

    <p>Welcome, valued user.</p>

@endif

@endsection
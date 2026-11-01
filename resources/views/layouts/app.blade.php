<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Indera Mahkota Community Announcement System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<header class="bg-primary text-white py-3">
    <div class="container">
        <h1 class="h4 mb-0">Indera Mahkota Community Announcement System</h1>
    </div>
</header>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <div class="navbar-nav me-auto">
            <a class="nav-link" href="{{ route('home') }}">Home</a>
            <a class="nav-link" href="{{ route('announcements.index') }}">Announcements</a>
            <a class="nav-link" href="{{ url('/documentation') }}">Documentation</a>
            @if(session('user_id'))
                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
            @endif
            @if(session('user_role') === 'admin')
                <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
            @endif
        </div>
        <div class="navbar-nav">
            @if(session('user_id'))
                <span class="navbar-text me-3">Hi, {{ session('user_name') }}</span>
                <form method="POST" action="{{ route('logout.perform') }}">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            @else
                <a class="nav-link" href="{{ route('login.show') }}">Login</a>
                <a class="nav-link" href="{{ route('register.show') }}">Register</a>
            @endif
        </div>
    </div>
</nav>

<main class="container my-4 flex-grow-1">
    @if(session('success'))
        <div class="alert alert-success flash">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger flash">{{ session('error') }}</div>
    @endif

    @yield('content')
</main>

<footer class="bg-dark text-white-50 text-center py-3 mt-auto">
    &copy; {{ date('Y') }} Indera Mahkota Community Announcement System
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // auto-hide flash messages after 4 seconds
    setTimeout(() => {
        document.querySelectorAll('.flash').forEach(el => el.remove());
    }, 4000);
</script>
@stack('scripts')
</body>
</html>
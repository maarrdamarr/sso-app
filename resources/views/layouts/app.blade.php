<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'Damar SSO' }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background: #f4f6fb; }
    .sidebar {
        min-height: 100vh;
        background: #0f172a;
        color: #fff;
    }
    .sidebar a {
        color: #fff;
        text-decoration: none;
        display: block;
        padding: .65rem 1rem;
        border-radius: .4rem;
    }
    .sidebar a.active, .sidebar a:hover {
        background: rgba(255,255,255,.14);
    }
    .app-card {
        background: #fff;
        border: 1px solid rgba(15,23,42,.05);
        border-radius: 1rem;
        padding: 1rem;
        transition: .2s;
    }
    .app-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(15,23,42,.08);
    }
  </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar p-3" style="width:240px">
        <h5 class="mb-3">Damar SSO</h5>
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-grid"></i> Dashboard</a>
        <a href="{{ route('applications.index') }}" class="{{ request()->routeIs('applications.*') ? 'active' : '' }}"><i class="bi bi-grid-3x3-gap"></i> Aplikasi</a>
        <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}"><i class="bi bi-people"></i> Pengguna</a>

        <form action="{{ route('logout') }}" method="post" class="mt-4">
            @csrf
            <button class="btn btn-sm btn-danger w-100"><i class="bi bi-box-arrow-left"></i> Keluar</button>
        </form>
    </div>
    <div class="flex-grow-1">
        <nav class="navbar bg-white border-bottom">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h6">{{ $title ?? '' }}</span>
                <span>Halo, {{ auth()->user()->name ?? '-' }}</span>
            </div>
        </nav>
        <main class="p-4">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>

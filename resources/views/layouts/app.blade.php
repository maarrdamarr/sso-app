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

    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid"></i> Dashboard
    </a>

    {{-- Profil saya (semua user) --}}
    @auth
        @if(Route::has('profile.index'))
            <a href="{{ route('profile.index') }}" class="{{ request()->routeIs('profile.index') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i> Profil Saya
            </a>
        @endif
    @endauth

    @auth
        {{-- admin utama --}}
        @if(auth()->user()->hasRole(['superadmin','it-admin']))
            <a href="{{ route('applications.index') }}" class="{{ request()->routeIs('applications.*') ? 'active' : '' }}">
                <i class="bi bi-grid-3x3-gap"></i> Aplikasi
            </a>
        @endif

        {{-- PERMINTAAN AKSES: user biasa --}}
        @if(Route::has('access-requests.create'))
            <a href="{{ route('access-requests.create') }}" class="{{ request()->routeIs('access-requests.create') ? 'active' : '' }}">
                <i class="bi bi-unlock"></i> Minta Akses
            </a>
        @endif

        {{-- PERMINTAAN SAYA --}}
        @if(Route::has('access-requests.my'))
            <a href="{{ route('access-requests.my') }}" class="{{ request()->routeIs('access-requests.my') ? 'active' : '' }}">
                <i class="bi bi-list-check"></i> Permintaan Saya
            </a>
        @endif

        {{-- menu user boleh dilihat HR juga --}}
        @if(auth()->user()->hasRole(['superadmin','it-admin','hr']) && Route::has('users.index'))
            <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Pengguna
            </a>
        @endif

        @if(auth()->user()->hasRole(['superadmin','it-admin','hr']) && Route::has('departments.index'))
            <a href="{{ route('departments.index') }}" class="{{ request()->routeIs('departments.*') ? 'active' : '' }}">
                <i class="bi bi-diagram-3"></i> Departemen
            </a>
        @endif

        @if(auth()->user()->hasRole(['superadmin','it-admin']) && Route::has('announcements.index'))
            <a href="{{ route('announcements.index') }}" class="{{ request()->routeIs('announcements.*') ? 'active' : '' }}">
                <i class="bi bi-megaphone"></i> Pengumuman
            </a>
        @endif

        {{-- APPROVAL AKSES: admin --}}
        @if(auth()->user()->hasRole(['superadmin','it-admin']) && Route::has('access-requests.index'))
            <a href="{{ route('access-requests.index') }}" class="{{ request()->routeIs('access-requests.index') ? 'active' : '' }}">
                <i class="bi bi-shield-check"></i> Approval Akses
            </a>
        @endif

        {{-- KATEGORI APLIKASI --}}
        @if(auth()->user()->hasRole(['superadmin','it-admin']) && Route::has('app-categories.index'))
            <a href="{{ route('app-categories.index') }}" class="{{ request()->routeIs('app-categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Kategori Aplikasi
            </a>
        @endif

        {{-- PENGATURAN SISTEM --}}
        @if(auth()->user()->hasRole(['superadmin']) && Route::has('settings.index'))
            <a href="{{ route('settings.index') }}" class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i> Pengaturan
            </a>
        @endif

        {{-- RIWAYAT SSO milik user --}}
        @if(Route::has('sso.my'))
            <a href="{{ route('sso.my') }}" class="{{ request()->routeIs('sso.my') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i> Riwayat SSO-ku
            </a>
        @endif

        {{-- Bantuan --}}
        @if(Route::has('help.index'))
            <a href="{{ route('help.index') }}" class="{{ request()->routeIs('help.index') ? 'active' : '' }}">
                <i class="bi bi-question-circle"></i> Bantuan
            </a>
        @endif

        @if(auth()->user()->hasRole(['superadmin','it-admin']))
            <a href="{{ route('roles.index') }}" class="{{ request()->routeIs('roles.*') ? 'active' : '' }}">
                <i class="bi bi-shield-lock"></i> Role
            </a>
            <a href="{{ route('sso.logs') }}" class="{{ request()->routeIs('sso.logs') ? 'active' : '' }}">
                <i class="bi bi-clipboard2-data"></i> Log SSO
            </a>
        @endif
    @endauth

    <form action="{{ route('logout') }}" method="post" class="mt-4">
        @csrf
        <button class="btn btn-sm btn-danger w-100">
            <i class="bi bi-box-arrow-left"></i> Keluar
        </button>
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
          @auth
              @php
                  $announcements = \App\Models\Announcement::where('is_active', true)
                      ->latest('published_at')
                      ->take(3)
                      ->get();
              @endphp
              @if($announcements->count())
                  <div class="mb-4">
                      <h6 class="mb-2">Pengumuman</h6>
                      <div class="row g-2">
                          @foreach ($announcements as $ann)
                              <div class="col-md-4">
                                  <div class="p-3 bg-white rounded border">
                                      <h6 class="mb-1">{{ $ann->title }}</h6>
                                      <small class="text-muted d-block mb-1">
                                          {{ $ann->published_at?->format('d M Y H:i') }}
                                      </small>
                                      <p class="mb-0" style="font-size: .85rem">
                                          {{ \Illuminate\Support\Str::limit($ann->body, 120) }}
                                      </p>
                                  </div>
                              </div>
                          @endforeach
                      </div>
                  </div>
              @endif
          @endauth

          @yield('content')
      </main>
  </div>
</div>
</body>
</html>

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
        padding: .55rem 1rem;
        border-radius: .4rem;
        font-size: .875rem;
    }
    .sidebar a.active, .sidebar a:hover {
        background: rgba(255,255,255,.14);
    }
    .sidebar .menu-title {
        font-size: .65rem;
        text-transform: uppercase;
        letter-spacing: .04em;
        opacity: .5;
        margin-top: 1.2rem;
        margin-bottom: .35rem;
        padding: 0 .25rem;
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

      {{-- ========== NAVIGASI ========== --}}
      <div class="menu-title">Navigasi</div>
      <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <i class="bi bi-grid me-2"></i> Dashboard
      </a>

      {{-- ========== AKUN SAYA ========== --}}
      @auth
        <div class="menu-title">Akun saya</div>
        @if(Route::has('profile.index'))
            <a href="{{ route('profile.index') }}" class="{{ request()->routeIs('profile.index') ? 'active' : '' }}">
                <i class="bi bi-person-circle me-2"></i> Profil Saya
            </a>
        @endif

        @if(Route::has('sso.my'))
            <a href="{{ route('sso.my') }}" class="{{ request()->routeIs('sso.my') ? 'active' : '' }}">
                <i class="bi bi-clock-history me-2"></i> Riwayat SSO-ku
            </a>
        @endif

        {{-- ========== LAYANAN KARYAWAN ========== --}}
        <div class="menu-title">Layanan</div>

        @if(Route::has('access-requests.create'))
            <a href="{{ route('access-requests.create') }}" class="{{ request()->routeIs('access-requests.create') ? 'active' : '' }}">
                <i class="bi bi-unlock me-2"></i> Minta Akses
            </a>
        @endif

        @if(Route::has('access-requests.my'))
            <a href="{{ route('access-requests.my') }}" class="{{ request()->routeIs('access-requests.my') ? 'active' : '' }}">
                <i class="bi bi-list-check me-2"></i> Permintaan Saya
            </a>
        @endif

        @if(Route::has('tickets.create'))
            <a href="{{ route('tickets.create') }}" class="{{ request()->routeIs('tickets.create') ? 'active' : '' }}">
                <i class="bi bi-life-preserver me-2"></i> Tiket IT
            </a>
        @endif

        @if(Route::has('tickets.my'))
            <a href="{{ route('tickets.my') }}" class="{{ request()->routeIs('tickets.my') ? 'active' : '' }}">
                <i class="bi bi-list-task me-2"></i> Tiket Saya
            </a>
        @endif

        @if(Route::has('quick-links.public'))
            <a href="{{ route('quick-links.public') }}" class="{{ request()->routeIs('quick-links.public') ? 'active' : '' }}">
                <i class="bi bi-link-45deg me-2"></i> Link Cepat
            </a>
        @endif

        @if(Route::has('feedback.create'))
            <a href="{{ route('feedback.create') }}" class="{{ request()->routeIs('feedback.create') ? 'active' : '' }}">
                <i class="bi bi-chat-left-dots me-2"></i> Kirim Feedback
            </a>
        @endif

        {{-- ========== DATA PERUSAHAAN (HR / ADMIN) ========== --}}
        @if(auth()->user()->hasRole(['superadmin','it-admin','hr']))
          <div class="menu-title">Data perusahaan</div>

          @if(Route::has('users.index'))
              <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                  <i class="bi bi-people me-2"></i> Pengguna
              </a>
          @endif

          @if(Route::has('departments.index'))
              <a href="{{ route('departments.index') }}" class="{{ request()->routeIs('departments.*') ? 'active' : '' }}">
                  <i class="bi bi-diagram-3 me-2"></i> Departemen
              </a>
          @endif
        @endif

        {{-- ========== ADMIN SSO ========== --}}
        @if(auth()->user()->hasRole(['superadmin','it-admin']))
          <div class="menu-title">Admin SSO</div>

          <a href="{{ route('applications.index') }}" class="{{ request()->routeIs('applications.*') ? 'active' : '' }}">
              <i class="bi bi-grid-3x3-gap me-2"></i> Aplikasi
          </a>

          @if(Route::has('announcements.index'))
              <a href="{{ route('announcements.index') }}" class="{{ request()->routeIs('announcements.*') ? 'active' : '' }}">
                  <i class="bi bi-megaphone me-2"></i> Pengumuman
              </a>
          @endif

          @if(Route::has('access-requests.index'))
              <a href="{{ route('access-requests.index') }}" class="{{ request()->routeIs('access-requests.index') ? 'active' : '' }}">
                  <i class="bi bi-shield-check me-2"></i> Approval Akses
              </a>
          @endif

          @if(Route::has('app-categories.index'))
              <a href="{{ route('app-categories.index') }}" class="{{ request()->routeIs('app-categories.*') ? 'active' : '' }}">
                  <i class="bi bi-tags me-2"></i> Kategori Aplikasi
              </a>
          @endif

          @if(Route::has('settings.index'))
              <a href="{{ route('settings.index') }}" class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
                  <i class="bi bi-gear me-2"></i> Pengaturan
              </a>
          @endif

          @if(Route::has('tickets.index'))
              <a href="{{ route('tickets.index') }}" class="{{ request()->routeIs('tickets.index') ? 'active' : '' }}">
                  <i class="bi bi-inboxes me-2"></i> Tiket IT (Admin)
              </a>
          @endif

          @if(Route::has('quick-links.index'))
              <a href="{{ route('quick-links.index') }}" class="{{ request()->routeIs('quick-links.index') ? 'active' : '' }}">
                  <i class="bi bi-collection me-2"></i> Link Cepat (Admin)
              </a>
          @endif

          @if(Route::has('feedback.index'))
              <a href="{{ route('feedback.index') }}" class="{{ request()->routeIs('feedback.index') ? 'active' : '' }}">
                  <i class="bi bi-envelope-open me-2"></i> Feedback
              </a>
          @endif

          <a href="{{ route('roles.index') }}" class="{{ request()->routeIs('roles.*') ? 'active' : '' }}">
              <i class="bi bi-shield-lock me-2"></i> Role
          </a>
          <a href="{{ route('sso.logs') }}" class="{{ request()->routeIs('sso.logs') ? 'active' : '' }}">
              <i class="bi bi-clipboard2-data me-2"></i> Log SSO
          </a>
        @endif

      @endauth

      {{-- tombol logout --}}
      <form action="{{ route('logout') }}" method="post" class="mt-4">
          @csrf
          <button class="btn btn-sm btn-danger w-100">
              <i class="bi bi-box-arrow-left me-1"></i> Keluar
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

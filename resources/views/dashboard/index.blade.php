@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
  <h4 class="mb-3">Selamat datang, {{ $user->name }}</h4>
  <p class="text-muted mb-4">Ini adalah pusat SSO perusahaan. Pilih aplikasi di bawah untuk masuk.</p>

  <div class="row g-3">
    @forelse ($apps as $app)
      <div class="col-12 col-md-4 col-lg-3">
        <a href="{{ route('sso.redirect', $app->slug) }}" class="text-decoration-none text-dark">
            <div class="app-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="fs-3 text-primary">
                        <i class="bi {{ $app->icon ?? 'bi-grid' }}"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">{{ $app->name }}</h6>
                        <small class="text-muted">{{ $app->url }}</small>
                    </div>
                </div>
            </div>
        </a>
      </div>
    @empty
      <p>Belum ada aplikasi.</p>
    @endforelse
  </div>
@endsection

@extends('layouts.app', ['title' => 'Aplikasi'])

@section('content')
  <h5 class="mb-3">Daftar Aplikasi Perusahaan</h5>

  <div class="row g-3">
    @foreach ($apps as $app)
        <div class="col-md-4">
            <div class="app-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="mb-0">{{ $app->name }}</h6>
                        <small class="text-muted">{{ $app->url }}</small>
                    </div>
                    <span class="badge {{ $app->active ? 'bg-success' : 'bg-secondary' }}">
                        {{ $app->active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
                <small class="text-muted d-block mt-2">slug: {{ $app->slug }}</small>
            </div>
        </div>
    @endforeach
  </div>
@endsection

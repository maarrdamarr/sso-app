@extends('layouts.app', ['title' => 'Aplikasi'])

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Daftar Aplikasi Perusahaan</h5>
    <a href="{{ route('applications.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus"></i> Tambah
    </a>
  </div>

  @if (session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
  @endif

  <div class="row g-3">
    @foreach ($apps as $app)
        <div class="col-md-4">
            <div class="app-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="mb-0">{{ $app->name }}</h6>
                        <small class="text-muted">{{ $app->url }}</small>
                        <div class="mt-2">
                            @foreach ($app->roles as $r)
                                <span class="badge bg-secondary">{{ $r->label ?? $r->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <span class="badge {{ $app->active ? 'bg-success' : 'bg-secondary' }}">
                        {{ $app->active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
                <div class="mt-3 d-flex gap-2">
                    <a href="{{ route('applications.edit', $app) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    <a href="{{ route('applications.roles', $app) }}" class="btn btn-sm btn-outline-secondary">Role</a>
                    <form action="{{ route('applications.destroy', $app) }}" method="post" onsubmit="return confirm('Hapus aplikasi?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
  </div>
@endsection

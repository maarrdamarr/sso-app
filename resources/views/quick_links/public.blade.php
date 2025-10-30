@extends('layouts.app', ['title' => 'Link Cepat'])

@section('content')
  <h5 class="mb-3">Link Cepat</h5>
  <p class="text-muted mb-3">Kumpulan tautan penting perusahaan.</p>

  <div class="row g-3">
    @forelse ($links as $link)
        <div class="col-md-4">
            <a href="{{ $link->url }}" target="_blank" class="text-decoration-none">
                <div class="p-3 bg-white rounded border h-100">
                    <div class="fw-semibold">{{ $link->title }}</div>
                    <small class="text-muted d-block">{{ $link->category ?? 'Umum' }}</small>
                    <small class="text-primary d-block mt-1">{{ $link->url }}</small>
                </div>
            </a>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info mb-0">Belum ada link.</div>
        </div>
    @endforelse
  </div>
@endsection

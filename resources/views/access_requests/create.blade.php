@extends('layouts.app', ['title' => 'Permintaan Akses'])

@section('content')
  <h5 class="mb-3">Ajukan Permintaan Akses Aplikasi</h5>

  <div class="bg-white p-3 rounded">
    <form action="{{ route('access-requests.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">Pilih Aplikasi</label>
            <select name="application_id" class="form-select" required>
                <option value="">-- pilih aplikasi --</option>
                @foreach ($apps as $app)
                    <option value="{{ $app->id }}">{{ $app->name }} ({{ $app->url }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Alasan</label>
            <textarea name="reason" rows="3" class="form-control" placeholder="contoh: saya butuh akses untuk pekerjaan harian"></textarea>
        </div>
        <button class="btn btn-primary">Kirim Permintaan</button>
        <a href="{{ route('access-requests.my') }}" class="btn btn-light">Lihat permintaan saya</a>
    </form>
  </div>
@endsection

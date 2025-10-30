@extends('layouts.app', ['title' => 'Buat Pengumuman'])

@section('content')
  <h5 class="mb-3">Buat Pengumuman</h5>

  <form action="{{ route('announcements.store') }}" method="post" class="bg-white p-3 rounded">
    @csrf
    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Isi</label>
        <textarea name="body" rows="4" class="form-control"></textarea>
    </div>
    <div class="form-check mb-3">
        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" checked>
        <label for="is_active" class="form-check-label">Aktif</label>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('announcements.index') }}" class="btn btn-light">Batal</a>
  </form>
@endsection

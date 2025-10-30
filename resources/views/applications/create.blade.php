@extends('layouts.app', ['title' => 'Tambah Aplikasi'])

@section('content')
  <h5 class="mb-3">Tambah Aplikasi</h5>

  <form action="{{ route('applications.store') }}" method="post" class="bg-white p-3 rounded">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control" required>
        <small class="text-muted">Contoh: hris, eoffice, elp</small>
    </div>
    <div class="mb-3">
        <label class="form-label">URL</label>
        <input type="text" name="url" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Icon (Bootstrap Icons)</label>
        <input type="text" name="icon" class="form-control" placeholder="bi-people-fill">
    </div>
    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" name="active" id="active" checked>
        <label class="form-check-label" for="active">Aktif</label>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('applications.index') }}" class="btn btn-light">Batal</a>
  </form>
@endsection

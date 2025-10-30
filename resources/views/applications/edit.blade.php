@extends('layouts.app', ['title' => 'Edit Aplikasi'])

@section('content')
  <h5 class="mb-3">Edit Aplikasi</h5>

  <form action="{{ route('applications.update', $application) }}" method="post" class="bg-white p-3 rounded">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="name" class="form-control" value="{{ $application->name }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ $application->slug }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">URL</label>
        <input type="text" name="url" class="form-control" value="{{ $application->url }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Icon</label>
        <input type="text" name="icon" class="form-control" value="{{ $application->icon }}">
    </div>
    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" name="active" id="active" {{ $application->active ? 'checked' : '' }}>
        <label class="form-check-label" for="active">Aktif</label>
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('applications.index') }}" class="btn btn-light">Batal</a>
  </form>
@endsection

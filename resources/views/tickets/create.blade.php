@extends('layouts.app', ['title' => 'Buat Tiket IT'])

@section('content')
  <h5 class="mb-3">Buat Tiket IT</h5>
  <form action="{{ route('tickets.store') }}" method="post" class="bg-white p-3 rounded">
    @csrf
    <div class="mb-2">
      <label class="form-label">Subjek</label>
      <input type="text" name="subject" class="form-control" required>
    </div>
    <div class="mb-2">
      <label class="form-label">Prioritas</label>
      <select name="priority" class="form-select">
        <option value="low">Rendah</option>
        <option value="medium" selected>Normal</option>
        <option value="high">Tinggi</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Deskripsi</label>
      <textarea name="description" rows="4" class="form-control"></textarea>
    </div>
    <button class="btn btn-primary">Kirim</button>
  </form>
@endsection

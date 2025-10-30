@extends('layouts.app', ['title' => 'Kirim Feedback'])

@section('content')
  <h5 class="mb-3">Kirim Feedback</h5>

  @if (session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
  @endif

  <div class="bg-white p-3 rounded">
    <form action="{{ route('feedback.store') }}" method="post">
        @csrf
        <div class="mb-2">
            <label class="form-label">Subjek</label>
            <input type="text" name="subject" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Pesan</label>
            <textarea name="message" rows="4" class="form-control" required></textarea>
        </div>
        <button class="btn btn-primary">Kirim</button>
    </form>
  </div>
@endsection

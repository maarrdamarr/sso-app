@extends('layouts.app', ['title' => 'Redirecting...'])

@section('content')
  <div class="card">
    <div class="card-body">
      <h5>SSO ke: {{ $app->name }}</h5>
      <p class="mb-1">User: {{ $user->name }} ({{ $user->email }})</p>
      <p class="mb-1">Token: <code>{{ $token }}</code></p>
      <p class="text-muted">Ini hanya simulasi SSO (tanpa API). Di real project, token ini dikirim ke aplikasi tujuan.</p>
      @if($app->url)
        <a href="{{ $app->url }}" class="btn btn-primary mt-2">Buka Aplikasi</a>
      @endif
    </div>
  </div>
@endsection

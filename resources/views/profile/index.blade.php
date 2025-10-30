@extends('layouts.app', ['title' => 'Profil Saya'])

@section('content')
  <h5 class="mb-3">Profil Saya</h5>

  @if (session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
  @endif

  <div class="row g-3">
    <div class="col-md-6">
        <div class="bg-white p-3 rounded">
            <h6 class="mb-3">Data Akun</h6>
            <div class="mb-2">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" value="{{ $user->name }}" disabled>
            </div>
            <div class="mb-2">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" value="{{ $user->email }}" disabled>
            </div>
            <div class="mb-2">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" value="{{ $user->username ?? '-' }}" disabled>
            </div>
            <div class="mb-2">
                <label class="form-label">Departemen</label>
                <input type="text" class="form-control" value="{{ $user->department->name ?? '-' }}" disabled>
            </div>
            <div class="mb-2">
                <label class="form-label">Role</label><br>
                @foreach ($user->roles as $r)
                    <span class="badge bg-primary">{{ $r->label ?? $r->name }}</span>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="bg-white p-3 rounded">
            <h6 class="mb-3">Ubah Password</h6>
            <form action="{{ route('profile.updatePassword') }}" method="post">
                @csrf
                <div class="mb-2">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button class="btn btn-primary btn-sm mt-1">Simpan</button>
            </form>
        </div>
    </div>
  </div>
@endsection

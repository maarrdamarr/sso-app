@extends('layouts.app', ['title' => 'Edit Pengguna'])

@section('content')
  <h5 class="mb-3">Edit Pengguna</h5>

  <form action="{{ route('users.update', $user) }}" method="post" class="bg-white p-3 rounded">
    @csrf
    @method('PUT')
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Password (kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="col-md-3">
            <label class="form-label">Departemen</label>
            <select name="department_id" class="form-select">
                <option value="">-- pilih --</option>
                @foreach ($departments as $dep)
                    <option value="{{ $dep->id }}" {{ $user->department_id == $dep->id ? 'selected' : '' }}>
                        {{ $dep->name }}
                    </option>
                @endforeach
            </select>
        </div>

        @unless(auth()->user()->hasRole('hr'))
            <div class="col-md-12">
                <label class="form-label d-block mb-1">Role</label>
                @foreach ($roles as $r)
                    <div class="form-check form-check-inline">
                        <input
                            type="checkbox"
                            name="roles[]"
                            value="{{ $r->id }}"
                            class="form-check-input"
                            id="r{{ $r->id }}"
                            {{ $user->roles->contains('id', $r->id) ? 'checked' : '' }}
                        >
                        <label for="r{{ $r->id }}" class="form-check-label">{{ $r->label ?? $r->name }}</label>
                    </div>
                @endforeach
            </div>
        @endunless
    </div>

    <button class="btn btn-primary mt-3">Update</button>
    <a href="{{ route('users.index') }}" class="btn btn-light mt-3">Batal</a>
  </form>
@endsection

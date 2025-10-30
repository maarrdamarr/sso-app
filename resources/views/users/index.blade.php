@extends('layouts.app', ['title' => 'Pengguna'])

@section('content')
  <h5 class="mb-3">Daftar Pengguna</h5>

  @if (session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
  @endif

  <div class="table-responsive bg-white rounded">
    <table class="table table-sm mb-0 align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Username</th>
          <th>Email</th>
          <th>Departemen</th>
          <th>Role</th>
          <th>Atur</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->department->name ?? '-' }}</td>
            <td>
              @foreach ($user->roles as $r)
                <span class="badge bg-primary">{{ $r->label ?? $r->name }}</span>
              @endforeach
            </td>
            <td style="min-width: 180px">
              <form action="{{ route('users.roles.update', $user) }}" method="post" class="d-flex gap-1 flex-wrap">
                @csrf
                @foreach ($roles as $r)
                    <div class="form-check">
                        <input
                            type="checkbox"
                            name="roles[]"
                            value="{{ $r->id }}"
                            class="form-check-input"
                            id="u{{ $user->id }}r{{ $r->id }}"
                            {{ $user->roles->contains('id', $r->id) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="u{{ $user->id }}r{{ $r->id }}">
                            {{ $r->name }}
                        </label>
                    </div>
                @endforeach
                <button class="btn btn-sm btn-success mt-1">Simpan</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection

@extends('layouts.app', ['title' => 'Pengguna'])

@section('content')
  <h5 class="mb-3">Daftar Pengguna</h5>

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
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection

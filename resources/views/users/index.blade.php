@extends('layouts.app', ['title' => 'Pengguna'])

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Daftar Pengguna</h5>
    @if(auth()->user()->hasRole(['superadmin','it-admin','hr']))
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus"></i> Tambah
        </a>
    @endif
  </div>

  @if (session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
  @endif
  @if (session('error'))
    <div class="alert alert-danger py-2">{{ session('error') }}</div>
  @endif

  <div class="table-responsive bg-white rounded">
    <table class="table table-sm mb-0 align-middle">
      <thead>
        <tr>
          <th style="width:40px">#</th>
          <th>Nama</th>
          <th>Username</th>
          <th>Email</th>
          <th>Departemen</th>
          <th>Role</th>
          <th style="min-width: 180px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $u)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->username }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->department->name ?? '-' }}</td>
            <td>
              {{-- role yang dimiliki user ini --}}
              @foreach ($u->roles as $r)
                  <span class="badge bg-primary">{{ $r->label ?? $r->name }}</span>
              @endforeach
            </td>
            <td>
              <div class="d-flex flex-wrap gap-1">

                {{-- ===== tombol EDIT ===== --}}
                @if(auth()->user()->hasRole(['superadmin','it-admin']))
                    <a href="{{ route('users.edit', $u) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                @elseif(auth()->user()->hasRole('hr') && !$u->hasRole(['superadmin','it-admin','hr']))
                    {{-- HR hanya boleh edit karyawan --}}
                    <a href="{{ route('users.edit', $u) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                @endif

                {{-- ===== tombol HAPUS ===== --}}
                @if(auth()->user()->hasRole(['superadmin','it-admin'])
                    && !$u->hasRole('superadmin')
                    && auth()->id() !== $u->id)
                    <form action="{{ route('users.destroy', $u) }}" method="post" onsubmit="return confirm('Hapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                @endif

                {{-- ===== form atur role per user (hanya superadmin & it-admin) ===== --}}
                @if(auth()->user()->hasRole(['superadmin','it-admin']))
                    <form action="{{ route('users.roles.update', $u) }}" method="post" class="d-flex flex-wrap gap-1">
                        @csrf
                        @foreach ($roles as $r)
                            <div class="form-check form-check-inline">
                                <input
                                    type="checkbox"
                                    name="roles[]"
                                    value="{{ $r->id }}"
                                    id="u{{ $u->id }}r{{ $r->id }}"
                                    class="form-check-input"
                                    {{ $u->roles->contains('id', $r->id) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="u{{ $u->id }}r{{ $r->id }}">
                                    {{ $r->name }}
                                </label>
                            </div>
                        @endforeach
                        <button class="btn btn-sm btn-success mt-1">Simpan</button>
                    </form>
                @endif

              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection

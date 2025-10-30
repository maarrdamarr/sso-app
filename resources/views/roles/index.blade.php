@extends('layouts.app', ['title' => 'Role'])

@section('content')
  <h5 class="mb-3">Daftar Role</h5>

  @if (session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
  @endif
  @if (session('error'))
    <div class="alert alert-danger py-2">{{ session('error') }}</div>
  @endif

  <div class="row">
    <div class="col-md-4">
        <div class="bg-white p-3 rounded">
            <h6 class="mb-3">Tambah Role</h6>
            <form action="{{ route('roles.store') }}" method="post">
                @csrf
                <div class="mb-2">
                    <label class="form-label">Name (unique)</label>
                    <input type="text" name="name" class="form-control" required placeholder="mis: finance-head">
                </div>
                <div class="mb-2">
                    <label class="form-label">Label</label>
                    <input type="text" name="label" class="form-control" placeholder="mis: Kepala Keuangan">
                </div>
                <button class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="bg-white rounded p-3">
            <table class="table table-sm align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Role</th>
                        <th>Digunakan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->label ?? $role->name }}</td>
                            <td>{{ $role->users_count }} user</td>
                            <td>
                                @if ($role->name !== 'superadmin')
                                    <form action="{{ route('roles.destroy', $role) }}" method="post" onsubmit="return confirm('Hapus role ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                @else
                                    <span class="badge bg-secondary">default</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection

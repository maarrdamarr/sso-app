@extends('layouts.app', ['title' => 'Departemen'])

@section('content')
  <h5 class="mb-3">Departemen / Divisi</h5>

  @if (session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
  @endif

  <div class="row">
    <div class="col-md-4">
        <div class="bg-white p-3 rounded mb-3">
            <h6 class="mb-3">Tambah Departemen</h6>
            <form action="{{ route('departments.store') }}" method="post">
                @csrf
                <div class="mb-2">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" required placeholder="mis: Human Resource">
                </div>
                <div class="mb-2">
                    <label class="form-label">Kode</label>
                    <input type="text" name="code" class="form-control" placeholder="mis: HR">
                </div>
                <button class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="bg-white rounded p-3">
            <table class="table table-sm mb-0 align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Kode</th>
                        <th style="width: 120px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $dep)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dep->name }}</td>
                            <td>{{ $dep->code }}</td>
                            <td>
                                <form action="{{ route('departments.destroy', $dep) }}" method="post" onsubmit="return confirm('Hapus departemen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if($departments->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center py-3">Belum ada departemen.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection

@extends('layouts.app', ['title' => 'Kategori Aplikasi'])

@section('content')
  <h5 class="mb-3">Kategori Aplikasi</h5>

  @if (session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
  @endif

  <div class="row g-3">
    <div class="col-md-4">
        <div class="bg-white rounded p-3">
            <h6 class="mb-3">Tambah Kategori</h6>
            <form action="{{ route('app-categories.store') }}" method="post">
                @csrf
                <div class="mb-2">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="2"></textarea>
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
                        <th>Deskripsi</th>
                        <th>Aplikasi</th>
                        <th style="width:90px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $cat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cat->name }}</td>
                            <td>{{ $cat->description }}</td>
                            <td>{{ $cat->applications_count }}</td>
                            <td>
                                <form action="{{ route('app-categories.destroy', $cat) }}" method="post" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-3">Belum ada kategori.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection

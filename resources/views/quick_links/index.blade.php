@extends('layouts.app', ['title' => 'Link Cepat'])

@section('content')
  <h5 class="mb-3">Link Cepat</h5>

  @if (session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
  @endif

  <div class="row g-3">
    <div class="col-md-4">
        <div class="bg-white p-3 rounded">
            <h6 class="mb-3">Tambah Link</h6>
            <form action="{{ route('quick-links.store') }}" method="post">
                @csrf
                <div class="mb-2">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">URL</label>
                    <input type="text" name="url" class="form-control" required placeholder="https://...">
                </div>
                <div class="mb-2">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="category" class="form-control" placeholder="mis: HR, IT, Finance">
                </div>
                <div class="mb-2">
                    <label class="form-label">Urutan</label>
                    <input type="number" name="order" class="form-control" value="0">
                </div>
                <button class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="bg-white p-3 rounded">
            <table class="table table-sm mb-0 align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>URL</th>
                        <th>Kategori</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($links as $link)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $link->title }}</td>
                            <td>{{ $link->url }}</td>
                            <td>{{ $link->category ?? '-' }}</td>
                            <td>
                                <form action="{{ route('quick-links.destroy', $link) }}" method="post" onsubmit="return confirm('Hapus link ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-3">Belum ada link.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection

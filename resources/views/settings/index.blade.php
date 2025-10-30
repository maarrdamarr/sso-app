@extends('layouts.app', ['title' => 'Pengaturan Sistem'])

@section('content')
  <h5 class="mb-3">Pengaturan Sistem</h5>

  @if (session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
  @endif

  <div class="row g-3">
    <div class="col-md-4">
        <div class="bg-white p-3 rounded">
            <h6 class="mb-3">Tambah / Ubah</h6>
            <form action="{{ route('settings.store') }}" method="post">
                @csrf
                <div class="mb-2">
                    <label class="form-label">Key</label>
                    <input type="text" name="key" class="form-control" required placeholder="mis: company_name">
                </div>
                <div class="mb-2">
                    <label class="form-label">Value</label>
                    <input type="text" name="value" class="form-control" placeholder="mis: PT. Damar Project">
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
        <div class="bg-white p-3 rounded">
            <table class="table table-sm mb-0 align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Key</th>
                        <th>Value</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($settings as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><code>{{ $s->key }}</code></td>
                            <td>{{ $s->value }}</td>
                            <td>{{ $s->description }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center py-3">Belum ada pengaturan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection

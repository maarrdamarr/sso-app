@extends('layouts.app', ['title' => 'Pengumuman'])

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Pengumuman SSO</h5>
    <a href="{{ route('announcements.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus"></i> Buat Pengumuman
    </a>
  </div>

  @if (session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
  @endif

  <div class="bg-white rounded">
    <table class="table table-sm mb-0 align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Aktif</th>
                <th>Publish</th>
                <th>Pembuat</th>
                <th style="width:130px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($announcements as $ann)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ann->title }}</td>
                    <td>
                        <span class="badge {{ $ann->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $ann->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>{{ $ann->published_at ? $ann->published_at->format('d-m-Y H:i') : '-' }}</td>
                    <td>{{ $ann->author->name ?? '-' }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('announcements.edit', $ann) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('announcements.destroy', $ann) }}" method="post" onsubmit="return confirm('Hapus pengumuman?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-3">Belum ada pengumuman.</td></tr>
            @endforelse
        </tbody>
    </table>
  </div>
@endsection

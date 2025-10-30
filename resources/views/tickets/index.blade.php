@extends('layouts.app', ['title' => 'Tiket IT'])

@section('content')
  <h5 class="mb-3">Tiket IT - Semua Pengguna</h5>

  @if (session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
  @endif

  <div class="bg-white rounded">
    <table class="table table-sm mb-0 align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Pengguna</th>
                <th>Subjek</th>
                <th>Prioritas</th>
                <th>Status</th>
                <th>Dibuat</th>
                <th style="width:140px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->user->name }}<br><small class="text-muted">{{ $t->user->email }}</small></td>
                    <td style="max-width:240px">{{ $t->subject }}</td>
                    <td>{{ ucfirst($t->priority) }}</td>
                    <td>
                        @if($t->status === 'open')
                            <span class="badge bg-warning text-dark">Open</span>
                        @elseif($t->status === 'in-progress')
                            <span class="badge bg-info text-dark">Proses</span>
                        @else
                            <span class="badge bg-success">Selesai</span>
                        @endif
                    </td>
                    <td>{{ $t->created_at->format('d-m-Y H:i') }}</td>
                    <td class="d-flex gap-1">
                        @if($t->status !== 'closed')
                            <form action="{{ route('tickets.updateStatus', $t) }}" method="post">
                                @csrf
                                <input type="hidden" name="status" value="in-progress">
                                <button class="btn btn-sm btn-outline-primary">Proses</button>
                            </form>
                            <form action="{{ route('tickets.updateStatus', $t) }}" method="post">
                                @csrf
                                <input type="hidden" name="status" value="closed">
                                <button class="btn btn-sm btn-outline-success">Tutup</button>
                            </form>
                        @else
                            <small class="text-muted">Ditutup</small>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center py-3">Tidak ada tiket.</td></tr>
            @endforelse
        </tbody>
    </table>
  </div>
@endsection

@extends('layouts.app', ['title' => 'Permintaan Akses'])

@section('content')
  <h5 class="mb-3">Permintaan Akses Pengguna</h5>

  @if (session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
  @endif

  <div class="bg-white rounded">
    <table class="table table-sm mb-0 align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Aplikasi</th>
                <th>Alasan</th>
                <th>Status</th>
                <th>Diajukan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($requests as $r)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $r->user->name }} <small class="text-muted d-block">{{ $r->user->email }}</small></td>
                    <td>{{ $r->application->name ?? '-' }}</td>
                    <td style="max-width: 240px;">{{ $r->reason }}</td>
                    <td>
                        @if($r->status === 'pending')
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @elseif($r->status === 'approved')
                            <span class="badge bg-success">Disetujui</span>
                            <small class="text-muted d-block">
                                oleh {{ $r->reviewer->name ?? '-' }}
                            </small>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                            <small class="text-muted d-block">
                                oleh {{ $r->reviewer->name ?? '-' }}
                            </small>
                        @endif
                    </td>
                    <td>{{ $r->created_at->format('d-m-Y H:i') }}</td>
                    <td class="d-flex gap-1">
                        @if($r->status === 'pending')
                            <form action="{{ route('access-requests.approve', $r) }}" method="post">
                                @csrf
                                <button class="btn btn-sm btn-success">Setujui</button>
                            </form>
                            <form action="{{ route('access-requests.reject', $r) }}" method="post">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger">Tolak</button>
                            </form>
                        @else
                            <small class="text-muted">Selesai</small>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center py-3">Belum ada permintaan.</td></tr>
            @endforelse
        </tbody>
    </table>
  </div>
@endsection

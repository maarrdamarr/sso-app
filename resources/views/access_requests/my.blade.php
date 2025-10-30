@extends('layouts.app', ['title' => 'Permintaan Akses Saya'])

@section('content')
  <h5 class="mb-3">Permintaan Akses Saya</h5>

  @if (session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
  @endif

  <div class="bg-white rounded">
    <table class="table table-sm mb-0 align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Aplikasi</th>
                <th>Alasan</th>
                <th>Status</th>
                <th>Diperiksa</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($requests as $r)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $r->application->name ?? '-' }}</td>
                    <td>{{ $r->reason ?? '-' }}</td>
                    <td>
                        @if($r->status === 'pending')
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @elseif($r->status === 'approved')
                            <span class="badge bg-success">Disetujui</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        @if($r->reviewed_at)
                            {{ $r->reviewed_at->format('d-m-Y H:i') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-3">Belum ada permintaan.</td></tr>
            @endforelse
        </tbody>
    </table>
  </div>
@endsection

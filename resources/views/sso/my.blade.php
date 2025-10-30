@extends('layouts.app', ['title' => 'Riwayat SSO-ku'])

@section('content')
  <h5 class="mb-3">Riwayat SSO-ku</h5>
  <p class="text-muted mb-3">Riwayat akses yang kamu lakukan ke aplikasi dari akun ini.</p>

  <div class="bg-white rounded">
    <table class="table table-sm mb-0 align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Waktu</th>
                <th>Aplikasi</th>
                <th>IP</th>
                <th>Perangkat</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($logs as $log)
                <tr>
                    <td>{{ $logs->firstItem() + $loop->index }}</td>
                    <td>{{ $log->created_at->format('d-m-Y H:i:s') }}</td>
                    <td>{{ $log->application->name ?? '-' }}</td>
                    <td>{{ $log->ip_address ?? '-' }}</td>
                    <td style="max-width: 250px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                        {{ $log->user_agent }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-3">Belum ada akses.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
  </div>

  <div class="mt-3">
    {{ $logs->links() }}
  </div>
@endsection

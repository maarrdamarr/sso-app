@extends('layouts.app', ['title' => 'Log SSO'])

@section('content')
  <h5 class="mb-3">Log SSO</h5>

  <form method="get" class="row g-2 mb-3">
    <div class="col-md-3">
        <select name="application_id" class="form-select">
            <option value="">-- Semua Aplikasi --</option>
            @foreach ($applications as $app)
                <option value="{{ $app->id }}" {{ $appId == $app->id ? 'selected' : '' }}>
                    {{ $app->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <select name="user_id" class="form-select">
            <option value="">-- Semua User --</option>
            @foreach ($users as $u)
                <option value="{{ $u->id }}" {{ $userId == $u->id ? 'selected' : '' }}>
                    {{ $u->name }} ({{ $u->email }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary w-100">Filter</button>
    </div>
  </form>

  <div class="table-responsive bg-white rounded">
    <table class="table table-sm align-middle mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Waktu</th>
                <th>User</th>
                <th>Aplikasi</th>
                <th>IP</th>
                <th>UA</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($logs as $log)
                <tr>
                    <td>{{ $logs->firstItem() + $loop->index }}</td>
                    <td>{{ $log->created_at->format('d-m-Y H:i:s') }}</td>
                    <td>{{ $log->user->name ?? '—' }}</td>
                    <td>{{ $log->application->name ?? '—' }}</td>
                    <td>{{ $log->ip_address ?? '—' }}</td>
                    <td style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $log->user_agent }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-3">Belum ada log.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
  </div>

  <div class="mt-3">
    {{ $logs->withQueryString()->links() }}
  </div>
@endsection

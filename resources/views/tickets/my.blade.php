@extends('layouts.app', ['title' => 'Tiket Saya'])

@section('content')
  <h5 class="mb-3">Tiket Saya</h5>

  @if (session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
  @endif

  <div class="bg-white rounded">
    <table class="table table-sm mb-0 align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Subjek</th>
                <th>Status</th>
                <th>Prioritas</th>
                <th>Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->subject }}</td>
                    <td>
                        @if($t->status === 'open')
                            <span class="badge bg-warning text-dark">Open</span>
                        @elseif($t->status === 'in-progress')
                            <span class="badge bg-info text-dark">Proses</span>
                        @else
                            <span class="badge bg-success">Selesai</span>
                        @endif
                    </td>
                    <td>{{ ucfirst($t->priority) }}</td>
                    <td>{{ $t->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-3">Belum ada tiket.</td></tr>
            @endforelse
        </tbody>
    </table>
  </div>
@endsection

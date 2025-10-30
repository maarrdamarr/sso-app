@extends('layouts.app', ['title' => 'Feedback Pengguna'])

@section('content')
  <h5 class="mb-3">Feedback Pengguna</h5>

  <div class="bg-white rounded">
    <table class="table table-sm mb-0 align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Subjek</th>
                <th>Pesan</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($feedback as $f)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $f->user->name ?? '-' }} <br> <small class="text-muted">{{ $f->user->email ?? '' }}</small></td>
                    <td>{{ $f->subject }}</td>
                    <td style="max-width: 350px;">{{ $f->message }}</td>
                    <td>{{ $f->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-3">Belum ada feedback.</td></tr>
            @endforelse
        </tbody>
    </table>
  </div>
@endsection

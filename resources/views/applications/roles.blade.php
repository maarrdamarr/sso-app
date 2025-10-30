@extends('layouts.app', ['title' => 'Role Aplikasi'])

@section('content')
  <h5 class="mb-3">Atur Role untuk: {{ $application->name }}</h5>

  <form action="{{ route('applications.roles.update', $application) }}" method="post" class="bg-white p-3 rounded">
    @csrf
    <div class="row">
        @foreach ($roles as $role)
            <div class="col-md-3">
                <div class="form-check mb-2">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="role_{{ $role->id }}"
                        name="roles[]"
                        value="{{ $role->id }}"
                        {{ in_array($role->id, $appRoleIds) ? 'checked' : '' }}
                    >
                    <label for="role_{{ $role->id }}" class="form-check-label">
                        {{ $role->label ?? $role->name }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>

    <button class="btn btn-primary mt-3">Simpan</button>
    <a href="{{ route('applications.index') }}" class="btn btn-light mt-3">Kembali</a>
  </form>
@endsection

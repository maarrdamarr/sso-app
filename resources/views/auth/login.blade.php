<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login SSO - Damar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="min-height:100vh">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h4 class="text-center mb-3">Login SSO</h4>
            @if ($errors->any())
                <div class="alert alert-danger py-2">
                    {{ $errors->first() }}
                </div>
            @endif
            <form action="{{ route('login.do') }}" method="post">
              @csrf
              <div class="mb-3">
                <label class="form-label">Email / Username</label>
                <input type="text" name="login" class="form-control" value="{{ old('login') }}" required autofocus>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                  Ingat saya
                </label>
              </div>
              <button class="btn btn-primary w-100">Masuk</button>
            </form>
          </div>
        </div>
        <p class="text-center text-muted mt-3 mb-0" style="font-size:.75rem">DamarProject SSO Center</p>
      </div>
    </div>
  </div>
</body>
</html>

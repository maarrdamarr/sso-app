@extends('layouts.app', ['title' => 'Bantuan'])

@section('content')
  <h5 class="mb-3">Bantuan & Panduan SSO</h5>

  <div class="bg-white p-3 rounded mb-3">
    <h6 class="mb-2">1. Cara login</h6>
    <ol class="mb-0">
        <li>Buka halaman SSO: (alamat sesuai server kamu)</li>
        <li>Masukkan email/username dan password.</li>
        <li>Jika lupa password, hubungi admin / HR.</li>
    </ol>
  </div>

  <div class="bg-white p-3 rounded mb-3">
    <h6 class="mb-2">2. Mengakses aplikasi</h6>
    <p class="mb-1">Di dashboard akan tampil kartu-kartu aplikasi yang memang diberikan ke role kamu.</p>
    <p class="mb-0">Kalau aplikasi tidak muncul, berarti role kamu belum diberi akses oleh admin.</p>
  </div>

  <div class="bg-white p-3 rounded mb-3">
    <h6 class="mb-2">3. Siapa yang harus saya hubungi?</h6>
    <p class="mb-1">- Masalah akun / role: Admin SSO / IT</p>
    <p class="mb-1">- Masalah data karyawan: HR</p>
    <p class="mb-0">- Masalah aplikasi tertentu: PIC aplikasi tersebut.</p>
  </div>
@endsection

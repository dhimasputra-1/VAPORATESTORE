@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center" style="margin-top: 100px">
  <div class="col-lg-5">
    <div class="card shadow-lg border-0 rounded-lg">
      <div class="card-header text-center">
        <h4 class="text-primary font-weight-bold">Selamat Datang</h4>
      </div>
      <div class="card-body">
        @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/login">
          @csrf
          <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required autofocus>
          </div>

          <div class="form-group mb-4">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

      </div>
      <div class="card-footer text-center">
        <small>Belum punya akun? <a href="/register">Tambah User Baru</a></small>
      </div>
    </div>
  </div>
</div>
@endsection

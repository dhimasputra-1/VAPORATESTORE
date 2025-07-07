@extends('layouts.auth')

@section('title', 'Register User Baru')

@section('content')
<div class="row justify-content-center" style="margin-top: 100px">
  <div class="col-lg-5">
    <div class="card shadow-lg border-0 rounded-lg">
      <div class="card-header text-center">
        <h4 class="text-primary font-weight-bold">Tambah User Baru</h4>
      </div>
      <div class="card-body">

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="/register">
          @csrf

          <div class="form-group mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
          </div>

          <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Alamat Email" required>
          </div>

          <div class="form-group mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>

          <div class="form-group mb-4">
            <label>Role</label>
            <select name="role" class="form-control" required>
  <option value="">-- Pilih Role --</option>
  <option value="pemilik" {{ old('role') == 'pemilik' ? 'selected' : '' }}>Pemilik</option>
  <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
</select>
          </div>

          <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

      </div>
      <div class="card-footer text-center">
        <small>Sudah punya akun? <a href="/login">Login di sini</a></small>
      </div>
    </div>
  </div>
</div>
@endsection

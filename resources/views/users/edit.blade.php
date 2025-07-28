@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit User</h4>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password (kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="kasir" {{ $user->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
                <option value="pemilik" {{ $user->role == 'pemilik' ? 'selected' : '' }}>Pemilik</option>
            </select>
        </div>

        <button class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection

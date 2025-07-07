@extends('layouts.app')

@section('title', 'Daftar User')

@section('content')
<div class="container">
    <h1 class="mt-4">Daftar User</h1>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <a href="/register" class="btn btn-primary mb-3 mt-3">+ Tambah User Baru</a>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $index => $user)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

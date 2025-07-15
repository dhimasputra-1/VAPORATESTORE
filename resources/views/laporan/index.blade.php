@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h3 mb-4 text-gray-800">Menu Laporan</h1>
    <a href="{{ route('laporan.harian') }}" class="btn btn-primary mb-2">Laporan Harian</a>
    <a href="{{ route('laporan.bulanan') }}" class="btn btn-success mb-2">Laporan Bulanan</a>
    <a href="{{ route('laporan.tahunan') }}" class="btn btn-warning mb-2">Laporan Tahunan</a>
</div>
@endsection

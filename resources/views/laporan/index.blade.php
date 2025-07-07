@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Laporan</h1>

<div class="list-group">
  <a href="/laporan/harian" class="list-group-item list-group-item-action">Laporan Harian</a>
  <a href="/laporan/bulanan" class="list-group-item list-group-item-action">Laporan Bulanan</a>
  <a href="/laporan/tahunan" class="list-group-item list-group-item-action">Laporan Tahunan</a>
</div>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Vape Store')</title>

  {{-- Styles --}}
  <link href="{{ asset('sb-admin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('sb-admin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  {{-- Tambahan CSS jika diperlukan --}}
  @stack('styles')
</head>
<body id="page-top">
  <div id="wrapper">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">

        {{-- Topbar --}}
        @include('layouts.topbar')

        {{-- Main Content --}}
        <div class="container-fluid">
          @yield('content')
        </div>

      </div>
    </div>

  </div>

  {{-- Core Scripts --}}
  <script src="{{ asset('sb-admin2/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('sb-admin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('sb-admin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('sb-admin2/js/sb-admin-2.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  {{-- Tambahan script dari child view --}}
  @yield('scripts')

  {{-- Tambahan script alternatif pakai stack --}}
  @stack('scripts')
</body>
</html>

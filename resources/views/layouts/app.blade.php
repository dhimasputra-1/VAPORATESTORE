<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  {{-- Styles --}}
  <link href="{{ asset('sb-admin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('sb-admin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
  @stack('styles') {{-- Untuk stylesheet tambahan jika diperlukan --}}
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

  {{-- Scripts --}}
  <script src="{{ asset('sb-admin2/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('sb-admin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('sb-admin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('sb-admin2/js/sb-admin-2.min.js') }}"></script>
  @stack('scripts') {{-- Untuk script tambahan agar tidak duplikat --}}
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title')</title>
  <link href="{{ asset('sb-admin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('sb-admin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-primary">

  <div class="container">
    @yield('content')
  </div>

  <script src="{{ asset('sb-admin2/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('sb-admin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('sb-admin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('sb-admin2/js/sb-admin-2.min.js') }}"></script>
</body>
</html>

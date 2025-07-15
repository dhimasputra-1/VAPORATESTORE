<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Struk')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: white;
      padding: 20px;
      color: #000;
    }

    @media print {
      .no-print {
        display: none !important;
      }

      body {
        background: none;
      }
    }
  </style>
  @stack('styles')
</head>
<body>
  @yield('content')

  @stack('scripts')
</body>
</html>

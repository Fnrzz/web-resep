<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Responsive Admin & Dashboard Template">
  <meta name="author" content="Your Name">
  <meta name="keywords" content="admin, dashboard, template, responsive, css, html">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="shortcut icon" href="{{ asset('img/icons/icon-48x48.png') }}" />

  <title>ResepKu</title>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    @include('admin.layouts.sidebar')
    
    <div class="main">
      <!-- Navbar -->
      @include('admin.layouts.navbar')

      <main class="content">
        <!-- Content will be inserted here -->
        @yield('content')
      </main>

      <!-- Footer (if you have one) -->
      @include('admin.layouts.footer')
    </div>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
  
</body>
</html>
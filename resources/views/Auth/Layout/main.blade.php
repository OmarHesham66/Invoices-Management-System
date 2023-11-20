<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Responsive Login and Signup Form </title>

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">

  <!-- Boxicons CSS -->
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
  <section class="container forms">
    @yield('content')
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    @stack('js')
</body>

</html>
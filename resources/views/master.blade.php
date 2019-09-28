<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <title>The Life Passport</title>
  <link rel='shortcut icon' href='images/favicon.png' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Merriweather:300,400,500,600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
  <div id="page">
    @include('partials.header')
    <div id="content">
      @yield('content')
      @include('partials.footer')
    </div><!-- #primary -->
  </div><!-- #content -->
  </div><!-- #page -->
  <script src="{{ mix('js/app.js') }}"></script>
  <!-- START CUSTOM SCRIPTS -->
  @yield('scripts')
  <!-- END CUSTOM SCRIPTS -->
</body>

</html>
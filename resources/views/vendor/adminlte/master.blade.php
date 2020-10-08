<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
@yield('title', config('adminlte.title', 'AdminLTE 3'))
@yield('title_postfix', config('adminlte.title_postfix', ''))</title>

<link rel="shortcut icon" href="{{ asset('favicon.png') }}">



  <link rel="stylesheet" href="{{ asset('css/admin_custom.css?v=2')}}">

    @if(! config('adminlte.enabled_laravel_mix'))
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    @include('adminlte::plugins', ['type' => 'css'])

    @yield('adminlte_css_pre')

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @else
    

      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
      
      <link rel="stylesheet" href="{{asset('css/icomoon/style.css')}}">

    
    @endif

    @yield('adminlte_css')
</head>
<body class="@yield('classes_body')" @yield('body_data')>
  <div id="app">

@yield('body')


</div>

@if(! config('adminlte.enabled_laravel_mix'))
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

@include('adminlte::plugins', ['type' => 'js'])

@else
<script src="{{ mix('/js/app.js') }}"></script>
@endif

@if(Auth::user())
<script>
var my_userID = "{{ Auth::user()->id }}";

$('.alertinfo').delay(3000).slideUp(300);
</script>
@endif

@yield('adminlte_js')

</body>
</html>

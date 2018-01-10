<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'Bienvenido')</title>
	<link rel="stylesheet" href="{{ assets('css/bootstrap_real.css') }}">
	<link rel="stylesheet" href="{{ assets('css/styles.css') }}">
  @section('css-plugins')
  @show
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">@yield('brand', 'Bienvenido')</a>
    </div>

    @if( !is_null(getSessionUser()) && sessionActive())
      @include('includes.navbar_options')
    @endif
  </div><!-- /.container-fluid -->
</nav>
<body>
@section('body')
@show
</body>
<script src="{{ assets('js/jquery.js') }}"></script>
<script src="{{ assets('js/bootstrap_real.min.js') }}"></script>
@section('js-plugins')
@show
</body>
</html>
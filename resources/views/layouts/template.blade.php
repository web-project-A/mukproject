<!DOCTYPE html>
<html lang="en">
<head>

	<title>@yield('title')</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=4">

<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico')}}"/>

<link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css')}}">

<link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css')}}">

	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css')}}">

<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}">

</head>
<body >

	<div class="limiter">
		<div class="container-login100" style="background-color:#008000;">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">

                    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <img class="image" src="/images/index.jpeg" >
                <style>
                    .image{
                       width: 20%;
                     margin-right: 150px;
                    }
                </style>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">

                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->fname }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    </div>
		</div>
	</div>



	<div id="dropDownSelect1"></div>


<script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>

<script src="{{ asset('vendor/animsition/js/animsition.min.js')}}"></script>

<script src="{{ asset('vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>

<script src="{{ asset('vendor/select2/select2.min.js')}}"></script>

<script src="{{ asset('vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{ ('vendor/daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ asset('vendor/countdowntime/countdowntime.js')}}"></script>

<script src="{{ asset('js/main.js')}}"></script>

</body>
@yield('scripts')
</html>

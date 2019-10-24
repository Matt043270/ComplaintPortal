<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Murdoch Complaints Portal') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> 
<!--	<link rel="stylesheet" href"{{url('/css/style.css')}}" type='css/text'> -->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
					
	<!--				<a href="#" class="pull-left"> <img src="{{url('/images/murdoch_logo.jpg')}}" alt="Image"/></a> -->
					
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					
					
					
					<a class="navbar-brand" href="{{ url('/') }}">
						{{ config('app.name', 'Murdoch Complaints Portal') }}
					</a>
				</div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-left">
						
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li>
                                <a href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li >
                                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
							@if(Auth::user()->role === 'Admin')
								<li> <a class="dropdown-item" href="{{ url('admin/tickets') }}" onclick="event.preventDefault();
													 document.getElementById('admin-ticket-form').submit();"> View all complaints</a></li>

									<form id="admin-ticket-form" action="{{ url('admin/tickets') }}" method="GET" style="display: none;">
										@csrf
									</form>
									

								<li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
													 document.getElementById('logout-form').submit();"> Logout</a></li>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
							@elseif (Auth::user()->role === 'Agent')
								<li> <a class="dropdown-item" href="{{ url('agent/tickets') }}" onclick="event.preventDefault();
													 document.getElementById('agent-ticket-form').submit();"> View department complaints</a></li>

									<form id="agent-ticket-form" action="{{ url('agent/tickets') }}" method="GET" style="display: none;">
										@csrf
									</form>

								<li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
													 document.getElementById('logout-form').submit();">Logout</a></li>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
							@else
								<li><a class="dropdown-item" href="{{ url('new-ticket') }}" onclick="event.preventDefault();
													 document.getElementById('create-ticket-form').submit();"> Create a new complaint</a></li>

									<form id="create-ticket-form" action="{{ url('new-ticket') }}" method="GET" style="display: none;">
										@csrf
									</form>

								<li><a class="dropdown-item" href="{{ url('my_tickets') }}" onclick="event.preventDefault();
													 document.getElementById('user-ticket-form').submit();">View your complaint</a></li>

									<form id="user-ticket-form" action="{{ url('my_tickets') }}" method="GET" style="display: none;">
										@csrf
									</form>

								<li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
													 document.getElementById('logout-form').submit();"> Logout </a></li>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
							
							@endif
							
							
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

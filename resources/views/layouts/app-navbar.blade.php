<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TeamAnalytics</title>
        <link rel="icon" type="image/x-icon" href="images/Logo.svg" />

        <!-- CSS only -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

        <!-- JS, Popper.js, and jQuery -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Material icons -->
        <link rel="stylesheet" href="{{ asset('css/material-icons.min.css') }}" />
    </head>
	<body>

		<nav class="navbar navbar-expand-md mb-5">
            <a class="navbar-brand" href="{{ url('/') }}">
                TeamAnalytics
                <img style="padding-left:5px" src="/images/Logo.svg">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        @php
                            $echipa = App\Echipa::where('user_id','=',auth()->id() )->value('nume');
                        @endphp
                        <a class="nav-link" href="{{ url('/echipa/mea') }}" role="button">
                            @php
                            if( auth()->check() )
                            {
                                if( auth()->id() !== 1 )
                                {
                                    echo($echipa);
                                }
                                else
                                {
                                   echo("Utilizatori");
                                }
                            }
                            else
                            {
                              echo("Echipa mea");
                            }   
                            @endphp
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/jucator') }}" role="button">
                            JUCATORI
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/echipa">
                           CLUBURI
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/nationala">
                           NATIONALE
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/meci') }}" role="button">
                            MECIURI
                        </a>
                    </li>
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
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                </ul>
            </div>
        </nav>
		
		<main class="m-4">
            @yield('content')
        </main>
	</body>
</html>
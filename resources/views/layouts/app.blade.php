<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/menu.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="/css/app.css">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-warning sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/logofunforkids.png" alt="logo" width="50px">
                    Fun For Kids
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                      <li class="nav-item"><a href="{{ route('show.search.city') }}" class="nav-link">Événements prévus</a></li>
                      <li class="nav-item"><a href="{{ route('event.create') }}" class="nav-link">Créer un nouvel événement</a></li>
                      @auth
                        <li class="nav-item"><a href="{{ route('user.events') }}" class="nav-link">Mes événements</a></li>
                      @endauth

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('Se connecter') }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('S\'inscrire') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Se déconnecter') }}
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

    @yield('scripts')
</body>
</html>

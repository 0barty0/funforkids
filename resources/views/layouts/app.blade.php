<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Fabien Grondin">
    <meta name="description" content="Fun for kids propose des événements pour les enfants mis en ligne par les parents">
    <meta name="keywords" content="événement,enfant,parent,jeu,loisir">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Open graph -->
    <meta property="og:url"                content="http://funforkids.000webhostapp.com" />
    <meta property="og:title"              content="Fun for kids" />
    <meta property="og:description"        content="Des événements pour les enfants par les parents" />
    <meta property="og:image"              content="/images/home1.jpg" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Twitter card -->
    <meta name="twitter:card"              content="summary">
    <meta name="twitter:site"              content="@funforkids">
    <meta name="twitter:title"             content="Fun for kids">
    <meta name="twitter:description"       content="Des événements pour les enfants par les parents">
    <meta name="twitter:creator"           content="Fun for kids">
    <meta name="twitter:image:src"         content="/images/home1.jpg">
    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/menu.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css">

</head>
<body>
  <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '804964023031161',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v3.0'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

  <div id="wrapper" class="container-fluid d-flex flex-column p-0">
          <nav class="navbar navbar-expand-md navbar-light bg-warning sticky-top">
              <div class="container-fluid">
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

          @yield('header')

        <main class="flex-grow">
            @yield('content')
        </main>

        <footer>
          <div class="container-fluid">
            <div class="row justify-content-around">
              <div class="col-sm-4" id="social">
                  <h4 class="text-center">Partagez ce site</h4>
                  <div id="social_btn">
                    <a href="#" id="fb-button"><i class="fab fa-2x fa-facebook-square"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=http://funforkids.000webhostapp.com" target="_blank"><i class="fab fa-2x fa-twitter-square"></i></a>
                    <a href="https://plus.google.com/share?url=funforkids.000webhostapp.com" target="_blank"><i class="fab fa-2x fa-google-plus-square"></i></a>
                  </div>
              </div>
            </div>
              <p class="text-center">
                <i class="far fa-copyright"></i> Fun for kids 2018
              </p>
          </div>
        </footer>
  </div>
<script>
document.getElementById('fb-button').onclick = function(e) {
e.preventDefault();
FB.ui({
  method: 'share',
  mobile_iframe: true,
  href: 'http://funforkids.000webhostapp.com',
}, function(response){});
}
</script>
    @yield('scripts')
</body>
</html>

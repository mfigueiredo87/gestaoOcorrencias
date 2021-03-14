<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SGO-MF') }}</title>

    <!-- Styles -->
  <!--   <link rel="stylesheet" type="text/css" href="http://bootswatch.com/flatly/bootstrap.css">
 -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'SGO-MF') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <!-- listando o projecto adicionado ao utilizador -->
                        <!-- mostra a lista se o usuario fazer login -->
                        @if(auth()->check())
                        <form class="navbar-form">
                        <div class="form-group">
                            <select id="list_of_projects" name="" class="form-control">
                            <!-- mostrar todos os projectos que tem um usuario e principalmente o user logado. Relacao muitos as muitos -->
                            @foreach(auth()->user()->list_of_projects as $project)
                                <option value="{{ $project->id}}" @if($project->id==auth()->user()->selected_project_id) selected @endif>{{ $project->nome}}</option>
                            @endforeach
                            </select>
                        </div>
                        </form>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Iniciar Sessão</a></li>
                            <li><a href="{{ route('register') }}">Registar</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Terminar sessão
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
             <div class="row">
             <!-- para o menu lateral -->
             <div class="col-md-3">
                 @include('includes.menu')
             </div>
             <!-- pagina conteudo -->
             <div class="col-md-9">
                 @yield('content')
            </div>
            @include('includes.rodape')
            </div>
        </div>
       
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script> 
   <!--  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256/hVVnYaiADRTO2P2zUGmuLJrBBLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous" ></script> -->
   <!-- script para alternar o projecto do usuario logado -->
  
   @yield('scripts')
</body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Data Range Picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="/resources/css/app.css" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column h-100" style="background-color: #eee;">
    <div id="app" class="d-flex flex-column">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm ">
            <div class="container"><img src="/storage/app/public/imagens/logo.png" alt="">
                <a class="navbar-brand" href="{{ url('/evento') }}">
                    @include('layouts.app-logo')
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item mx-2">
                                <a href="/evento/list" class="btn btn-outline-dark rounded-pill"><strong>Venda na Propozzito</strong></a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="btn btn-danger rounded-pill" href="{{ route('login') }}">Entrar</a>
                            </li>
                        @else
                            <ul class="nav nav-pill">
                                <li class="nav-item">
                                    <a href="/evento/list" class="btn btn-outline-dark rounded-pill"><strong>Venda na Propozzito</strong></a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark fw-bolder" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->nome }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('inscricao.list') }}">
                                            Histórico
                                        </a>
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
                            </ul>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 mb-auto h-100">
            @yield('content')
        </main>

        <footer class="footer py-3 " style="background-color: rgb(141, 153, 174);">
            <div class="container d-flex justify-center">
                <a class="navbar-brand m-auto" href="{{ url('/evento') }}">
                    @include('layouts.app-logo')
                </a>
            </div>
        </footer>
    </div>
</body>
</html>

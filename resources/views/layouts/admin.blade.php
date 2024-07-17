<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'fotoAlbum') }}</title>

    <!-- Fonts -->
    <!--<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&display=swap" rel="stylesheet">-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Patua+One&display=swap"
        rel="stylesheet">


    <!-- FontAwesome 6.2.0 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Usando Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-image-admin-blade"> <!--prim-green -->
    <div id="app" class="">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm nav-admin-page">
            <div class="container">

                <!--<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{*{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>-->

                <div class="collapse navbar-collapse d-flex" id="navbarSupportedContent">
                    <div class="nav-element">
                        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                            <div class="logo-fotoAlbum ">
                                <h1 class="display-5 fw-bold">FotoAlbum</h1>
                            </div>
                            {{-- config('app.name', 'Laravel') --}}
                        </a>
                    </div>
                    <!-- Left Side Of Navbar px-3-->
                    <ul class="navbar-nav m-auto nav-element d-flex justify-content-between">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">
                                <i class="fas fa-house px-1"></i>{{ __('Home') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('admin.photos.index') ? 'active' : '' }}"
                                href="{{ route('admin.photos.index') }}">
                                <i class="fas fa-camera px-1"></i>
                                {{ __('Foto') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('admin.photos.create') ? 'active' : '' }}"
                                href="{{ route('admin.photos.create') }}">
                                <i class="fas fa-plus-circle px-1"></i> {{ __('Crea') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('admin.categories.index') ? 'active' : '' }}"
                                href="{{ route('admin.categories.index') }}"><i class="fas fa-palette px-1"></i>
                                {{ __('Categories') }}</a>
                        </li>
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto nav-element justify-content-end">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }} active </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <!--<a class="dropdown-item" href="{*{ url('admin') }}">{*{ __('Dashboard') }}</a>-->
                                    <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>
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
            </div>
        </nav>

        <main class="bg-image-admin-blade">
            @yield('content')
        </main>
    </div>
</body>

</html>

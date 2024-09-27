<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Penjualan rumah ') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <style>
        /* Enhanced Navbar Styling */
        .navbar {
            background: linear-gradient(135deg, #6777ef, #47c9e5);
            padding: 1rem 2.5rem;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: #fff;
            transition: color 0.3s;
        }

        .navbar-brand:hover {
            color: #e0e0e0;
        }

        .navbar-nav .nav-link {
            color: #fff;
            font-size: 1.1rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #e0e0e0;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .dropdown-menu .dropdown-item {
            color: #333;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        /* Toggler Icon Styling */
        .navbar-toggler-icon {
            background-image: url('data:image/svg+xml;charset=utf8,%3Csvg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"%3E%3Cpath stroke="rgba%28255, 255, 255, 0.7%29" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/%3E%3C/svg%3E');
        }

        /* Form Search Styling */
        .nav-search-form {
            display: flex;
            align-items: center;
        }

        .nav-search-input {
            margin-right: 10px;
            border: none;
            border-radius: 5px 0 0 5px;
            padding: 6px 10px;
            font-size: 14px;
        }

        .nav-search-button {
            border: none;
            border-radius: 0 5px 5px 0;
            padding: 6px 12px;
            font-size: 14px;
            background-color: #47c9e5;
            color: #fff;
            transition: background-color 0.3s;
        }

        .nav-search-button:hover {
            background-color: #3ab0d5;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Penjualan rumah ') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <form action="{{ route('home') }}" method="GET" class="nav-search-form">
                                <input type="text" name="query" placeholder="Cari transaksi"
                                    class="nav-search-input form-control">
                                <button type="submit" class="nav-search-button btn btn-outline-light">Cari</button>
                            </form>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- Profile Dropdown -->
                            @php
                                $count = App\models\Transaction::count();
                            @endphp
                            <li class="nav-item">
                                <span><a href="{{ route('transactions.history') }}"
                                        class="nav-link">History <span>{{ $count }}</span>
                                    </a></span>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a href="{{ route('houses.index') }}" class="dropdown-item">House</a>
                                    <a href="{{ route('fasilitas.index') }}" class="dropdown-item">Fasilitas</a>
                                    <a href="{{ route('sales.index') }}" class="dropdown-item">Sales</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
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
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if ("serviceWorker" in navigator) {
            navigator.serviceWorker.register("/sw.js").then(
                (registration) => {
                    console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                }
            );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>
</body>

</html>

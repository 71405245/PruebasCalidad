<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('styles')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dark-mode body {
            background-color: #2e2e2e;
            color: #ffffff;
        }

        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.15rem rgba(220, 53, 69, 0.25);
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Navbar light */
        .navbar-light-custom {
            background-color: #ffffff !important;
        }

        .navbar-light-custom .navbar-brand,
        .navbar-light-custom .nav-link,
        .navbar-light-custom .navbar-toggler {
            color: #dc3545 !important;
        }

        /* Navbar dark */
        .navbar-dark-custom {
            background-color: #dc3545 !important;
        }

        .navbar-dark-custom .navbar-brand,
        .navbar-dark-custom .nav-link,
        .navbar-dark-custom .navbar-toggler {
            color: #ffffff !important;
        }

        .dark-mode .navbar {
            background-color: #dc3545 !important;
        }
        
    /* ✅ FOOTER DARK MODE */
    .dark-mode footer {
    background-color: #2e2e2e !important;
    color: #ffffff !important;
}

.dark-mode .footer .text-muted {
    color: #cccccc !important;
}
    </style>
</head>

<body class="d-flex flex-column h-100">
    <div id="app">
        <!-- Navigation Bar -->
        <nav id="mainNavbar" class="navbar navbar-expand-md shadow-sm navbar-light-custom">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center fs-4 fw-bold" href="{{ url('/') }}">
                    <img src="{{ asset('storage/logo.jpg') }}" alt="Logo" height="40"
                        class="me-2 d-inline-block align-text-top">
                    <span class="fw-bold">Ssamanth Clothes Shein</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-navbar"
                    aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="main-navbar">
                    <!-- Left -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                    href="{{ route('dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                                </a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item me-3">
                            <button id="darkModeToggle" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-moon"></i>
                            </button>
                        </li>

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-1"></i> Login
                                    </a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-1"></i> Register
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="user-dropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                            <i class="fas fa-user-cog me-1"></i> Perfil
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                                        </a>
                                    </li>
                                </ul>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="flex-shrink-0 py-4">
            <div class="container">
                @include('flash::message')
                @yield('content')
            </div>
        </main>

        <footer class="footer mt-auto py-3 bg-light">
            <div class="container text-center">
                <span class="text-muted">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Todos los derechos reservados.
                </span>
            </div>
        </footer>
    </div>

    <!-- Dark Mode Script -->
    <script>
        const toggle = document.getElementById('darkModeToggle');
        const html = document.documentElement;
        const navbar = document.getElementById('mainNavbar');

        function applyTheme(isDark) {
            if (isDark) {
                html.classList.add('dark-mode');
                navbar.classList.remove('navbar-light-custom');
                navbar.classList.add('navbar-dark-custom');
                localStorage.setItem('darkMode', 'true');
            } else {
                html.classList.remove('dark-mode');
                navbar.classList.remove('navbar-dark-custom');
                navbar.classList.add('navbar-light-custom');
                localStorage.setItem('darkMode', 'false');
            }
        }

        toggle.addEventListener('click', () => {
            const isDark = !html.classList.contains('dark-mode');
            applyTheme(isDark);
        });

        // Auto-load from localStorage
        document.addEventListener('DOMContentLoaded', () => {
            const dark = localStorage.getItem('darkMode') === 'true';
            applyTheme(dark);
        });
    </script>

    @stack('scripts')
    <link href="https://cdn.jsdelivr.net/npm/@n8n/chat/dist/style.css" rel="stylesheet" />
    <script type="module">
        import {
            createChat
        } from 'https://cdn.jsdelivr.net/npm/@n8n/chat/dist/chat.bundle.es.js';

        createChat({
            webhookUrl: "{{ env('AI_ENDPOINT') }}",
            defaultLanguage: 'es',
            initialMessages: [
                'Hola',
                '¿En qué puedo ayudarte hoy?'
            ],
            i18n: {
                es: {
                    title: 'Hola!',
                    subtitle: 'Comienza un chat',
                    footer: '',
                    getStarted: 'Nueva conversación',
                    inputPlaceholder: 'Pregúntame lo que quieras',
                },
            },
        });
    </script>
</body>

</html>
